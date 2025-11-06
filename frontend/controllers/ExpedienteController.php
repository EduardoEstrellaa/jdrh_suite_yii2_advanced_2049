<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use common\models\DatosPersonales;
use common\models\LugaresNacimiento;
use common\models\DomiciliosActuales;
use common\models\Municipios;

/**
 * ExpedienteController implements the CRUD actions for DatosPersonales model.
 */
class ExpedienteController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'eliminar' => ['POST'],
                        'municipios' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lista todos los expedientes del usuario actual.
     */
    public function actionIndex()
    {
        $perfil = Yii::$app->user->identity->perfil;
        if (!$perfil) {
            throw new NotFoundHttpException('Perfil no encontrado para este usuario.');
        }

        $query = DatosPersonales::find()->where(['perfil_id' => $perfil->id]);

        return $this->render('index', [
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 10],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            ]),
        ]);
    }

    /**
     * Muestra un expediente específico.
     */
    public function actionView($id)
    {
        $perfil = Yii::$app->user->identity->perfil;
        $datosPersonales = $this->findModel($id);

        if (!$perfil || $datosPersonales->perfil_id != $perfil->id) {
            throw new NotFoundHttpException('No puedes ver este expediente.');
        }

        $lugaresNacimiento = LugaresNacimiento::findOne(['perfil_id' => $perfil->id]);
        $domicilioActual = DomiciliosActuales::findOne(['perfil_id' => $perfil->id]);

        if (!$lugaresNacimiento || !$domicilioActual) {
            Yii::$app->session->setFlash('warning', 'Algunas secciones del expediente no están completas.');
        }

        return $this->render('view', [
            'datosPersonales' => $datosPersonales,
            'lugaresNacimiento' => $lugaresNacimiento,
            'domicilioActual' => $domicilioActual,
        ]);
    }

    /**
     * Crea un nuevo expediente con sus datos relacionados.
     */
    public function actionCreate()
    {
        $usuario = Yii::$app->user->identity;
        $perfil = $usuario ? $usuario->perfil : null;

        $datosPersonales = new DatosPersonales();
        $lugaresNacimiento = new LugaresNacimiento();
        $domicilioActual = new DomiciliosActuales();

        if (
            $datosPersonales->load(Yii::$app->request->post()) &&
            $lugaresNacimiento->load(Yii::$app->request->post()) &&
            $domicilioActual->load(Yii::$app->request->post())
        ) {
            if ($perfil) {
                $datosPersonales->perfil_id = $perfil->id;
                $lugaresNacimiento->perfil_id = $perfil->id;
                $domicilioActual->perfil_id = $perfil->id;
            }

            $isValid = $datosPersonales->validate() &&
                $lugaresNacimiento->validate() &&
                $domicilioActual->validate();

            if ($isValid) {
                $datosPersonales->save(false);
                $lugaresNacimiento->save(false);
                $domicilioActual->save(false);

                Yii::$app->session->setFlash('success', 'Expediente guardado correctamente.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'datosPersonales' => $datosPersonales,
            'lugaresNacimiento' => $lugaresNacimiento,
            'domicilioActual' => $domicilioActual,
        ]);
    }

    /**
     * Actualiza un expediente existente.
     */
    public function actionUpdate($id)
    {
        $perfil = Yii::$app->user->identity->perfil;
        $datosPersonales = $this->findModel($id);

        if ($datosPersonales->perfil_id != $perfil->id) {
            throw new NotFoundHttpException('No puedes editar este expediente.');
        }

        $lugaresNacimiento = LugaresNacimiento::findOne(['perfil_id' => $perfil->id]);
        $domicilioActual = DomiciliosActuales::findOne(['perfil_id' => $perfil->id]);

        if (
            $datosPersonales->load(Yii::$app->request->post()) &&
            $lugaresNacimiento->load(Yii::$app->request->post()) &&
            $domicilioActual->load(Yii::$app->request->post())
        ) {
            $isValid = $datosPersonales->validate() &&
                $lugaresNacimiento->validate() &&
                $domicilioActual->validate();

            if ($isValid) {
                $datosPersonales->save(false);
                $lugaresNacimiento->save(false);
                $domicilioActual->save(false);

                Yii::$app->session->setFlash('success', 'Expediente actualizado correctamente.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'datosPersonales' => $datosPersonales,
            'lugaresNacimiento' => $lugaresNacimiento,
            'domicilioActual' => $domicilioActual,
        ]);
    }

    /**
     * Elimina un expediente y sus registros relacionados.
     */
    public function actionDelete($id)
    {
        $perfil = Yii::$app->user->identity->perfil;
        $datosPersonales = $this->findModel($id);

        if ($datosPersonales->perfil_id != $perfil->id) {
            throw new NotFoundHttpException('No puedes eliminar este expediente.');
        }

        LugaresNacimiento::deleteAll(['perfil_id' => $perfil->id]);
        DomiciliosActuales::deleteAll(['perfil_id' => $perfil->id]);
        $datosPersonales->delete();

        Yii::$app->session->setFlash('success', 'Expediente eliminado correctamente.');
        return $this->redirect(['index']);
    }

    /**
     * Busca un modelo por ID.
     */
    protected function findModel($id)
    {
        if (($model = DatosPersonales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El expediente solicitado no existe.');
    }

    /**
     * Devuelve los municipios de una entidad federativa (para AJAX).
     */
    public function actionMunicipios($estado_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $municipios = Municipios::find()
            ->where(['entidades_federativas_id' => $estado_id])
            ->select(['id', 'nombre'])
            ->orderBy('nombre')
            ->asArray()
            ->all();

        $result = [];
        foreach ($municipios as $m) {
            $result[$m['id']] = $m['nombre'];
        }

        return $result;
    }
}
