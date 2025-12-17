<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Alumnos;
use common\models\Perfil;
use common\models\Municipios;
use common\services\ExpedienteService;
use yii\data\ActiveDataProvider;

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
                ],
            ],
        ]);
    }

    /* ============================================================= */
    /* INDEX: solo carga datos para listado                          */
    /* ============================================================= */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Alumnos::find()->with([
                'perfil',
                'generaciones',
                'planLicenciaturas.licenciaturas'
            ]),
            'pagination' => ['pageSize' => 20],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id',
                    'matricula',
                    'nombreCompleto' => [
                        'asc' => ['perfil.nombre' => SORT_ASC],
                        'desc' => ['perfil.nombre' => SORT_DESC],
                    ]
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /* ============================================================= */
    /* VIEW: carga TODO el expediente con sus relaciones             */
    /* ============================================================= */
    public function actionView($id)
    {
        $alumno = Alumnos::find()
            ->where(['id' => $id])
            ->with([
                'perfil',
                'perfil.datosPersonales',
                'perfil.lugaresNacimientos.entidadesFederativas',
                'perfil.lugaresNacimientos.municipios',
                'perfil.domiciliosActuales.entidadesFederativas',
                'perfil.domiciliosActuales.municipios',
                'generaciones',
                'planLicenciaturas.licenciaturas'
            ])
            ->one();

        if (!$alumno) {
            throw new NotFoundHttpException('Alumno no encontrado.');
        }

        $perfil = $alumno->perfil;
        $models = ExpedienteService::getModelsForUpdate($perfil->id, $alumno->id);

        return $this->render('view', array_merge([
            'perfil' => $perfil,
            'alumno' => $alumno,
        ], $models));
    }

    /* ============================================================= */
    /* UPDATE: carga alumno + perfil + modelos para update           */
    /* ============================================================= */
    public function actionUpdate($id)
    {
        $alumno = $this->findAlumnoModel($id);
        $perfil = $alumno->perfil;

        $models = ExpedienteService::getModelsForUpdate($perfil->id, $alumno->id);

        if (Yii::$app->request->isPost) {
            try {
                if (ExpedienteService::actualizarExpediente($perfil->id, $alumno->id, Yii::$app->request->post())) {
                    Yii::$app->session->setFlash('success', 'Expediente actualizado correctamente.');
                    return $this->redirect(['view', 'id' => $alumno->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error al guardar el expediente.');
                }
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Error: ' . $e->getMessage());
            }
        }

        return $this->render('update', array_merge([
            'perfil' => $perfil,
            'alumno' => $alumno,
        ], $models));
    }

    /* ============================================================= */
    /* DELETE: solo carga alumno + perfil, no todo el expediente     */
    /* ============================================================= */
    public function actionDelete($id)
    {
        $alumno = $this->findAlumnoModel($id);
        $perfil = $alumno->perfil;

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
    /* METODO PRIVADO: solo carga alumno + perfil, nada más         */
    /* ============================================================= */
    private function findAlumnoModel($id)
    {
        $model = Alumnos::find()
            ->where(['id' => $id])
            ->with(['perfil']) // 🔥 SOLO lo necesario para delete/update
            ->one();

        if (!$model) {
            throw new NotFoundHttpException('El alumno solicitado no existe.');
        }
        return $model;
    }
}
