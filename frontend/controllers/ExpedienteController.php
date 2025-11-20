<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\{
    Perfil,
    DatosPersonales,
    LugaresNacimiento,
    DomiciliosActuales,
    Municipios,
    Alumnos
};
use common\services\ExpedienteService;

class ExpedienteController extends Controller
{
    /** 
     * Comportamientos del controlador.
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
        if (!$perfil) {
            return $this->render('datos-incompletos', [
                'titulo' => 'Información básica requerida',
                'mensaje' => 'No se encontró un perfil asociado a tu cuenta.',
                'boton' => 'Crear/Actualizar Perfil',
                'urlAccion' => ['/perfil/create'],
            ]);
        }

        $alumno = $this->findAlumno($perfil->id);
        if (!$alumno) {
            return $this->render('datos-incompletos', [
                'titulo' => 'Falta información académica',
                'mensaje' => 'No se encontró información de alumno asociada a tu perfil.',
                'boton' => 'Editar Perfil',
                'urlAccion' => ['/perfil/update', 'id' => $perfil->id],
            ]);
        }

        // ✅ MEJOR: Usar el servicio para verificar existencia
        $models = ExpedienteService::getModelsForUpdate($perfil->id);

        $existeExpediente = $models['datosPersonales']->isNewRecord === false
            || $models['lugaresNacimiento']->isNewRecord === false
            || $models['domiciliosActuales']->isNewRecord === false;

        if ($existeExpediente) {
            return $this->redirect(['view']);
        }

        return $this->redirect(['create']);
    }

    /**
     * Muestra el expediente del usuario autenticado.
     */
    public function actionView()
    {
        [$perfil, $alumno] = $this->checkPerfilAndAlumno();

        // Obtener modelos del servicio
        $models = ExpedienteService::getModelsForUpdate($perfil->id);

        return $this->render('view', array_merge([
            'perfil' => $perfil,
            'alumno' => $alumno,
        ], $models));
    }

    /**
     * Crea un nuevo expediente.
     */
    public function actionCreate()
    {
        [$perfil, $alumno] = $this->checkPerfilAndAlumno();

        $post = Yii::$app->request->post();
        if ($post) {
            if (ExpedienteService::crearExpediente($perfil, $post)) {
                Yii::$app->session->setFlash('success', 'Expediente guardado correctamente.');
                return $this->redirect(['view']);
            }
            Yii::$app->session->setFlash('error', 'Error al guardar el expediente. Verifica los datos.');
        }

        // 🔄 CAMBIO: Usar getModelsForCreate en lugar de getModelsForUpdate
        $models = ExpedienteService::getModelsForCreate($perfil->id);

        return $this->render('create', array_merge([
            'perfil' => $perfil,
            'alumno' => $alumno,
        ], $models));
    }


    /**
     * Actualiza un expediente existente.
     */
    public function actionUpdate($perfil_id)
    {
        $perfil = Perfil::findOne($perfil_id);
        if (!$perfil) {
            throw new NotFoundHttpException('El perfil no existe.');
        }

        $alumno = Alumnos::find()->where(['perfil_id' => $perfil_id])->one();

        // Obtener modelos del servicio
        $models = ExpedienteService::getModelsForUpdate($perfil_id);

        // Procesar el formulario
        if ($this->request->isPost) {
            try {
                if (ExpedienteService::actualizarExpediente($perfil_id, $this->request->post())) {
                    Yii::$app->session->setFlash('success', 'Expediente actualizado correctamente.');
                    return $this->redirect(['view', 'perfil_id' => $perfil_id]);
                } else {
                    Yii::$app->session->addFlash('error', 'Error al guardar el expediente. Verifica los datos.');
                }
            } catch (\Exception $e) {
                Yii::$app->session->addFlash('error', 'Error al guardar: ' . $e->getMessage());
            }
        }

        return $this->render('update', array_merge([
            'perfil' => $perfil,
            'alumno' => $alumno,
        ], $models));
    }

    /**
     * Elimina un expediente y sus registros relacionados.
     */
    public function actionDelete($perfil_id)
    {
        [$perfil] = $this->checkPerfilAndAlumno($perfil_id);

        try {
            ExpedienteService::eliminarExpediente($perfil_id);
            Yii::$app->session->setFlash('success', 'Expediente eliminado correctamente.');
        } catch (\Throwable $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Ocurrió un error al eliminar el expediente.');
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
     * Obtiene el perfil del usuario autenticado.
     */
    private function getPerfil()
    {
        return Yii::$app->user->identity->perfil ?? null;
    }

    /**
     * Verifica que el perfil y el alumno existan y opcionalmente que coincida el perfil_id.
     */
    private function checkPerfilAndAlumno($perfil_id = null)
    {
        $perfil = $this->getPerfil();
        if (!$perfil) {
            Yii::$app->session->setFlash('error', 'No se encontró un perfil asociado a tu cuenta.');
            return $this->redirect(['/perfil/create']);
        }

        if ($perfil_id && $perfil->id != $perfil_id) {
            throw new NotFoundHttpException('No puedes acceder a este expediente.');
        }

        $alumno = $this->findAlumno($perfil->id);
        if (!$alumno) {
            Yii::$app->session->setFlash('error', 'No se encontró información de alumno asociada a tu perfil.');
            return $this->redirect(['/perfil/update', 'id' => $perfil->id]);
        }
        return [$perfil, $alumno];
    }

    /**
     * Busca un alumno por perfil.
     */
    private function findAlumno($perfilId)
    {
        return Alumnos::find()
            ->where(['perfil_id' => $perfilId])
            ->with(['generaciones', 'planLicenciaturas.licenciaturas'])
            ->one();
    }
}
