<?php
// frontend/controllers/ExpedienteController.php

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
    Alumnos,
    EdadesHijos
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
        $checkResult = $this->checkPerfilAndAlumno();

        // Si checkPerfilAndAlumno retorna un Response (redirección), lo retornamos
        if ($checkResult instanceof \yii\web\Response) {
            return $checkResult;
        }

        // Si llegamos aquí, checkResult es un array con [perfil, alumno]
        [$perfil, $alumno] = $checkResult;

        if (ExpedienteService::expedienteExiste($perfil->id, $alumno->id)) {
            return $this->redirect(['view']);
        }

        return $this->redirect(['create']);
    }

    /**
     * Muestra el expediente del usuario autenticado.
     */
    public function actionView()
    {
        $checkResult = $this->checkPerfilAndAlumno();

        if ($checkResult instanceof \yii\web\Response) {
            return $checkResult;
        }

        [$perfil, $alumno] = $checkResult;

        $models = ExpedienteService::getModelsForUpdate($perfil->id, $alumno->id);

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
        $checkResult = $this->checkPerfilAndAlumno();

        if ($checkResult instanceof \yii\web\Response) {
            return $checkResult;
        }

        [$perfil, $alumno] = $checkResult;

        $post = Yii::$app->request->post();
        if ($post) {
            if (ExpedienteService::crearExpediente($perfil, $alumno, $post)) {
                Yii::$app->session->setFlash('success', 'Expediente guardado correctamente.');
                return $this->redirect(['view']);
            }
            Yii::$app->session->setFlash('error', 'Error al guardar el expediente. Verifica los datos.');
        }

        $models = ExpedienteService::getModelsForCreate($perfil, $alumno);

        return $this->render('create', array_merge([
            'perfil' => $perfil,
            'alumno' => $alumno,
        ], $models));
    }

    /**
     * Actualiza un expediente existente.
     */
    public function actionUpdate()
    {
        $checkResult = $this->checkPerfilAndAlumno();

        if ($checkResult instanceof Response) {
            return $checkResult;
        }

        [$perfil, $alumno] = $checkResult;

        $models = ExpedienteService::getModelsForUpdate($perfil->id, $alumno->id);
        $edadesHijos = EdadesHijos::findAll([
            'alum_info_hijos_id' => $models['alumInfoHijos']->id
        ]);

        if ($this->request->isPost) {
            try {
                if (ExpedienteService::actualizarExpediente($perfil->id, $alumno->id, $this->request->post())) {
                    Yii::$app->session->setFlash('success', 'Expediente actualizado correctamente.');
                    return $this->redirect(['view']);
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
            'edadesHijos' => $edadesHijos,
        ], $models));
    }

    /**
     * Elimina un expediente y sus registros relacionados.
     */
    public function actionDelete()
    {
        $checkResult = $this->checkPerfilAndAlumno();

        if ($checkResult instanceof \yii\web\Response) {
            return $checkResult;
        }

        [$perfil, $alumno] = $checkResult;

        try {
            ExpedienteService::eliminarExpediente($perfil->id, $alumno->id);
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
     * Verifica que el perfil y el alumno existan.
     * Retorna un array [perfil, alumno] si todo está bien, o un Response si hay que redirigir.
     */
    private function checkPerfilAndAlumno()
    {
        $perfil = $this->getPerfil();
        if (!$perfil) {
            Yii::$app->session->setFlash('error', 'No se encontró un perfil asociado a tu cuenta.');
            return $this->redirect(['/perfil/create']);
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
