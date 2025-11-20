<?php

namespace backend\controllers;

use common\models\Equipos;
use backend\models\search\EquiposSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Modelos;
use common\models\EstadoEquipo;
use common\models\Marcas;
use common\models\TipoEquipo;
use common\models\TipoAlta;

/**
 * EquiposController implements the CRUD actions for Equipos model.
 */
class EquiposController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Equipos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EquiposSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Equipos model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Equipos model.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Equipos();

        // listas para dropdown
        $modelos = ArrayHelper::map(Modelos::find()->all(), 'id', 'descripcion');
        $estados = ArrayHelper::map(EstadoEquipo::find()->all(), 'id', 'descripcion');
        $marcas = ArrayHelper::map(Marcas::find()->all(), 'id', 'descripcion');
        $tiposEquipo = ArrayHelper::map(TipoEquipo::find()->all(), 'id_tipo_equipo', 'descripcion');
        $tiposAlta = ArrayHelper::map(TipoAlta::find()->all(), 'id', 'descripcion');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'marcas' => $marcas,
            'modelos' => [],
            'estados' => $estados,
            'tiposEquipo' => $tiposEquipo,
            'tiposAlta' => $tiposAlta,
        ]);
    }

    /**
     * Updates an existing Equipos model.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // listas para dropdown
        $modelos = ArrayHelper::map(Modelos::find()->all(), 'id', 'descripcion');
        $estados = ArrayHelper::map(EstadoEquipo::find()->all(), 'id', 'descripcion');
        $marcas = ArrayHelper::map(Marcas::find()->all(), 'id', 'descripcion');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'estados' => $estados,
        ]);
    }

    /**
     * Deletes an existing Equipos model.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Equipos model based on primary key.
     */
    protected function findModel($id)
    {
        if (($model = Equipos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // Acción para traer modelos por marca (AJAX)
    public function actionListModelos($id)
    {
        $modelos = Modelos::find()
            ->where(['marcas_id' => $id])
            ->orderBy('descripcion')
            ->all();

        if (!empty($modelos)) {
            foreach ($modelos as $modelo) {
                echo "<option value='{$modelo->id}'>{$modelo->descripcion}</option>";
            }
        } else {
            echo "<option value=''>No hay modelos disponibles</option>";
        }
    }
}
