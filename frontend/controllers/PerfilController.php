<?php

namespace frontend\controllers;

use frontend\models\Perfil;
use frontend\models\search\PerfilSearch;
use common\models\Alumnos;
use common\models\PermisosHelpers;
use common\models\RegistrosHelpers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * PerfilController implements the CRUD actions for Perfil model.
 */
class PerfilController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'update'],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return PermisosHelpers::requerirEstado('Activo');
                            }
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [],
                ],
            ]
        );
    }

    /**
     * Lists all Perfil models or redirects to create if doesn't exist.
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        return $this->handleProfileViewOrRedirect();
    }

    /**
     * Displays a single Perfil model.
     *
     * @return string|\yii\web\Response
     */
    public function actionView()
    {
        return $this->handleProfileViewOrRedirect();
    }

    /**
     * Creates a new Perfil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // Si ya existe perfil, redirige a la vista
        if ($this->userHasProfile()) {
            return $this->redirectToProfileView();
        }

        $model = new Perfil();
        $model->user_id = Yii::$app->user->id;
        $alumno = new Alumnos();

        if ($this->loadAndSaveProfile($model, $alumno)) {
            Yii::$app->session->setFlash('success', 'Perfil creado correctamente.');
            return $this->redirect(['view']);
        }

        return $this->render('create', [
            'model' => $model,
            'alumno' => $alumno,
        ]);
    }

    /**
     * Updates an existing Perfil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        PermisosHelpers::requerirUpgradeA('Pago');

        $model = $this->findUserProfile();
        $alumno = $this->findOrCreateAlumno($model->id);

        if ($this->loadAndSaveProfile($model, $alumno)) {
            Yii::$app->session->setFlash('success', 'Perfil actualizado correctamente.');
            return $this->redirect(['view']);
        }

        return $this->render('update', [
            'model' => $model,
            'alumno' => $alumno,
        ]);
    }

    /**
     * Deletes an existing Perfil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @return \yii\web\Response
     */
    /*     public function actionDelete()
    {
        $model = $this->findUserProfile();
        $model->delete();

        return $this->redirect(['site/index']);
    }
    */

    /**
     * Finds the Perfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     * @return Perfil
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Perfil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página solicitada no existe.');
    }

    /**
     * Common handler for view actions that redirect to create if profile doesn't exist
     *
     * @return string|\yii\web\Response
     */
    private function handleProfileViewOrRedirect()
    {
        if ($this->userHasProfile()) {
            return $this->renderProfileView();
        }

        return $this->redirect(['create']);
    }

    /**
     * Check if user has a profile
     *
     * @return bool
     */
    private function userHasProfile()
    {
        return RegistrosHelpers::userTiene('perfil');
    }

    /**
     * Render profile view with existing model
     *
     * @return string
     */
    private function renderProfileView()
    {
        $profileId = RegistrosHelpers::userTiene('perfil');
        return $this->render('view', [
            'model' => $this->findModel($profileId),
        ]);
    }

    /**
     * Redirect to profile view
     *
     * @return \yii\web\Response
     */
    private function redirectToProfileView()
    {
        $profileId = RegistrosHelpers::userTiene('perfil');
        return $this->redirect(['view', 'id' => $profileId]);
    }

    /**
     * Find user's profile or throw exception
     *
     * @return Perfil
     * @throws NotFoundHttpException
     */
    private function findUserProfile()
    {
        $model = Perfil::find()->where(['user_id' => Yii::$app->user->id])->one();

        if (!$model) {
            throw new NotFoundHttpException('No existe el perfil.');
        }

        return $model;
    }

    /**
     * Find or create alumno for profile
     *
     * @param int $profileId
     * @return Alumnos
     */
    private function findOrCreateAlumno($profileId)
    {
        $alumno = Alumnos::find()->where(['perfil_id' => $profileId])->one();

        if (!$alumno) {
            $alumno = new Alumnos();
            $alumno->perfil_id = $profileId;
        }

        return $alumno;
    }

    /**
     * Load and save profile and alumno in transaction
     *
     * @param Perfil $model
     * @param Alumnos $alumno
     * @return bool
     */
    private function loadAndSaveProfile(Perfil $model, Alumnos $alumno)
    {
        if (!$model->load(Yii::$app->request->post()) || !$alumno->load(Yii::$app->request->post())) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!$model->save()) {
                throw new \Exception('No se pudo guardar el perfil: ' . $this->getModelErrors($model));
            }

            $alumno->perfil_id = $model->id;

            if (!$alumno->save()) {
                throw new \Exception('No se pudo guardar el alumno: ' . $this->getModelErrors($alumno));
            }

            $transaction->commit();
            Yii::info('Perfil guardado exitosamente', __METHOD__);
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error('Error guardando perfil: ' . $e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Error al guardar los datos: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get model errors as string
     *
     * @param \yii\db\ActiveRecord $model
     * @return string
     */
    private function getModelErrors($model)
    {
        return implode(', ', array_map(function ($errors) {
            return implode(', ', $errors);
        }, $model->errors));
    }
}
