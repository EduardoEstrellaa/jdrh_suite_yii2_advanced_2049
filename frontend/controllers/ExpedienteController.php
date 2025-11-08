<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\DatosPersonales;
use common\models\LugaresNacimiento;
use common\models\DomiciliosActuales;
use common\models\Municipios;
use common\models\Alumnos;
use common\services\ExpedienteService;

class ExpedienteController extends Controller
{
    /** 
     * Comportamientos del controlador.
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'municipios' => ['GET'],
                ],
            ],
        ]);
    }

    /**
     * Redirige al usuario según el estado de su expediente.
     */
    public function actionIndex()
    {
        $perfil = $this->getPerfil();

        $expediente = DatosPersonales::find()
            ->where(['perfil_id' => $perfil->id])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        if ($expediente) {
            return $this->redirect(['update', 'id' => $expediente->id]);
        }

        return $this->redirect(['create']);
    }

    /**
     * Muestra un expediente específico.
     */
    public function actionView($id)
    {
        $perfil = $this->getPerfil();
        $datosPersonales = $this->findModel($id);

        if ($datosPersonales->perfil_id !== $perfil->id) {
            throw new NotFoundHttpException(Yii::t('app', 'No puedes ver este expediente.'));
        }

        $alumno = $this->findAlumno($perfil->id);
        $lugaresNacimiento = LugaresNacimiento::findOne(['perfil_id' => $perfil->id]);
        $domicilioActual = DomiciliosActuales::findOne(['perfil_id' => $perfil->id]);

        if (!$lugaresNacimiento || !$domicilioActual) {
            Yii::$app->session->setFlash('warning', Yii::t('app', 'Algunas secciones del expediente no están completas.'));
        }

        return $this->render('view', [
            'perfil' => $perfil,
            'alumno' => $alumno,
            'datosPersonales' => $datosPersonales,
            'lugaresNacimiento' => $lugaresNacimiento,
            'domicilioActual' => $domicilioActual,
        ]);
    }

    /**
     * Crea un nuevo expediente y sus secciones relacionadas.
     */
    public function actionCreate()
    {
        $perfil = $this->getPerfil();

        if (DatosPersonales::find()->where(['perfil_id' => $perfil->id])->exists()) {
            Yii::$app->session->setFlash('info', Yii::t('app', 'Ya tienes un expediente creado.'));
            $expediente = DatosPersonales::find()
                ->where(['perfil_id' => $perfil->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();
            return $this->redirect(['update', 'id' => $expediente->id]);
        }

        $post = Yii::$app->request->post();
        if ($post) {
            $result = ExpedienteService::crearExpediente($perfil, $post);
            if ($result) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Expediente guardado correctamente.'));
                return $this->redirect(['view', 'id' => $result->id]);
            }
        }

        return $this->render('create', [
            'perfil' => $perfil,
            'alumno' => $this->findAlumno($perfil->id),
            'datosPersonales' => new DatosPersonales(),
            'lugaresNacimiento' => new LugaresNacimiento(),
            'domicilioActual' => new DomiciliosActuales(),
        ]);
    }

    /**
     * Actualiza un expediente existente.
     */
    public function actionUpdate($id)
    {
        $perfil = $this->getPerfil();
        $datosPersonales = $this->findModel($id);

        if ($datosPersonales->perfil_id !== $perfil->id) {
            throw new NotFoundHttpException(Yii::t('app', 'No puedes editar este expediente.'));
        }

        $post = Yii::$app->request->post();
        if ($post) {
            $result = ExpedienteService::actualizarExpediente($perfil, $id, $post);
            if ($result) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Expediente actualizado correctamente.'));
                return $this->redirect(['view', 'id' => $result->id]);
            }
        }

        return $this->render('update', [
            'perfil' => $perfil,
            'alumno' => $this->findAlumno($perfil->id),
            'datosPersonales' => $datosPersonales,
            'lugaresNacimiento' => LugaresNacimiento::findOne(['perfil_id' => $perfil->id]),
            'domicilioActual' => DomiciliosActuales::findOne(['perfil_id' => $perfil->id]),
        ]);
    }

    /**
     * Elimina un expediente y sus registros relacionados.
     */
    public function actionDelete($id)
    {
        $perfil = $this->getPerfil();
        $datosPersonales = $this->findModel($id);

        if ($datosPersonales->perfil_id !== $perfil->id) {
            throw new NotFoundHttpException(Yii::t('app', 'No puedes eliminar este expediente.'));
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            LugaresNacimiento::deleteAll(['perfil_id' => $perfil->id]);
            DomiciliosActuales::deleteAll(['perfil_id' => $perfil->id]);
            $datosPersonales->delete();
            $transaction->commit();

            Yii::$app->session->setFlash('success', Yii::t('app', 'Expediente eliminado correctamente.'));
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', Yii::t('app', 'Ocurrió un error al eliminar el expediente.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Devuelve los municipios de una entidad federativa (AJAX).
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

        return array_column($municipios, 'nombre', 'id');
    }

    /* ============================================================= */
    /* 🔒 MÉTODOS AUXILIARES PRIVADOS                                */
    /* ============================================================= */

    /**
     * Obtiene el perfil actual del usuario autenticado.
     * @throws NotFoundHttpException
     */
    private function getPerfil()
    {
        $perfil = Yii::$app->user->identity->perfil ?? null;
        if (!$perfil) {
            throw new NotFoundHttpException(Yii::t('app', 'Perfil no encontrado.'));
        }
        return $perfil;
    }

    /**
     * Busca un alumno por perfil con relaciones cargadas.
     */
    private function findAlumno($perfilId)
    {
        return Alumnos::find()
            ->where(['perfil_id' => $perfilId])
            ->with(['generaciones', 'planLicenciaturas.licenciaturas'])
            ->one();
    }

    /**
     * Busca un modelo de DatosPersonales por ID.
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        $model = DatosPersonales::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'El expediente solicitado no existe.'));
        }
        return $model;
    }
}
