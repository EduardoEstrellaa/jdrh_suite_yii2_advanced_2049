<?php
// frontend/controllers/ExpedienteController.php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\components\PerfilAlumnoResolver;
use common\models\Municipios;
use common\services\ExpedienteFacade;
use common\services\ExpedienteService;

class ExpedienteController extends Controller
{
    /** @var PerfilAlumnoResolver */
    private $perfilAlumnoResolver;

    /** @var ExpedienteFacade */
    private $expedienteFacade;

    public function __construct($id, $module, PerfilAlumnoResolver $perfilAlumnoResolver, ExpedienteFacade $expedienteFacade, $config = [])
    {
        $this->perfilAlumnoResolver = $perfilAlumnoResolver;
        $this->expedienteFacade = $expedienteFacade;
        parent::__construct($id, $module, $config);
    }

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
     * Redirige al usuario segun el estado de su expediente.
     */
    public function actionIndex()
    {
        $resolved = $this->perfilAlumnoResolver->resolve($this);
        if ($resolved->redirect instanceof Response) {
            return $resolved->redirect;
        }

        if (ExpedienteService::expedienteExiste($resolved->perfil->id, $resolved->alumno->id)) {
            return $this->redirect(['view']);
        }

        return $this->redirect(['create']);
    }

    /**
     * Muestra el expediente del usuario autenticado.
     */
    public function actionView()
    {
        $resolved = $this->perfilAlumnoResolver->resolve($this);
        if ($resolved->redirect instanceof Response) {
            return $resolved->redirect;
        }

        $models = $this->expedienteFacade->getUpdateData($resolved->perfil->id, $resolved->alumno->id);

        return $this->render('view', array_merge([
            'perfil' => $resolved->perfil,
            'alumno' => $resolved->alumno,
        ], $models));
    }

    /**
     * Crea un nuevo expediente.
     */
    public function actionCreate()
    {
        $resolved = $this->perfilAlumnoResolver->resolve($this);
        if ($resolved->redirect instanceof Response) {
            return $resolved->redirect;
        }

        $post = Yii::$app->request->post();
        if ($post) {
            $result = $this->expedienteFacade->create($resolved->perfil, $resolved->alumno, $post);
            if ($result->isOk()) {
                Yii::$app->session->setFlash('success', $result->message() ?: 'Expediente guardado correctamente.');
                return $this->redirect(['view']);
            }
            Yii::$app->session->setFlash('error', $result->message() ?: 'Error al guardar el expediente. Verifica los datos.');
        }

        $models = $this->expedienteFacade->getCreateData($resolved->perfil, $resolved->alumno);

        return $this->render('create', array_merge([
            'perfil' => $resolved->perfil,
            'alumno' => $resolved->alumno,
        ], $models));
    }

    /**
     * Actualiza un expediente existente.
     */
    public function actionUpdate()
    {
        $resolved = $this->perfilAlumnoResolver->resolve($this);
        if ($resolved->redirect instanceof Response) {
            return $resolved->redirect;
        }

        $models = $this->expedienteFacade->getUpdateData($resolved->perfil->id, $resolved->alumno->id);

        if ($this->request->isPost) {
            $result = $this->expedienteFacade->update($resolved->perfil->id, $resolved->alumno->id, $this->request->post());
            if ($result->isOk()) {
                Yii::$app->session->setFlash('success', $result->message() ?: 'Expediente actualizado correctamente.');
                return $this->redirect(['view']);
            }
            Yii::$app->session->addFlash('error', $result->message() ?: 'Error al guardar el expediente. Verifica los datos.');
        }

        return $this->render('update', array_merge([
            'perfil' => $resolved->perfil,
            'alumno' => $resolved->alumno,
        ], $models));
    }

    /**
     * Elimina un expediente y sus registros relacionados.
     */
    public function actionDelete()
    {
        $resolved = $this->perfilAlumnoResolver->resolve($this);
        if ($resolved->redirect instanceof Response) {
            return $resolved->redirect;
        }

        try {
            ExpedienteService::eliminarExpediente($resolved->perfil->id, $resolved->alumno->id);
            Yii::$app->session->setFlash('success', 'Expediente eliminado correctamente.');
        } catch (\Throwable $e) {
            Yii::error($e->getMessage(), __METHOD__);
            Yii::$app->session->setFlash('error', 'Ocurrio un error al eliminar el expediente.');
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
}
