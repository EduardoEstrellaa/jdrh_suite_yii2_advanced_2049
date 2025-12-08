<?php

namespace backend\controllers;

use Yii;
use yii\web\UploadedFile;
use common\models\Equipos;
use yii\data\ActiveDataProvider;
use backend\models\search\EquiposSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
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
     */
    public function actionIndex()
    {
        $searchModel = new EquiposSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Yii::debug($dataProvider->query->createCommand()->rawSql, 'equipos-sql');

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Equipos model.
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Equipos model.
     */
    public function actionCreate()
{
    $model = new Equipos();

    // listas de dropdown
    $modelos = ArrayHelper::map(Modelos::find()->all(), 'id', 'descripcion');
    $estados = ArrayHelper::map(EstadoEquipo::find()->all(), 'id', 'descripcion');
    $marcas = ArrayHelper::map(Marcas::find()->all(), 'id', 'descripcion');
    $tiposEquipo = ArrayHelper::map(TipoEquipo::find()->all(), 'id', 'descripcion');
    $tiposAlta = ArrayHelper::map(TipoAlta::find()->all(), 'id', 'descripcion');

    if ($this->request->isPost) {

        $model->load(Yii::$app->request->post());

        // FORMATO CORRECTO DE FECHA
        if ($model->fecha_alta) {
            $model->fecha_alta = str_replace('T', ' ', $model->fecha_alta) . ':00';
        }

        // Obtener archivos
        $model->file_foto_equipo = UploadedFile::getInstance($model, 'file_foto_equipo');
        $model->file_foto_numero_inventario = UploadedFile::getInstance($model, 'file_foto_numero_inventario');
        $model->file_foto_numero_serie = UploadedFile::getInstance($model, 'file_foto_numero_serie');

        if ($model->validate()) {

            // Ruta pública
            $path = Yii::getAlias('@frontend/web/uploads/equipos/');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Foto del equipo
            if ($model->file_foto_equipo) {
                $filename = uniqid() . '_' . $model->file_foto_equipo->baseName . '.' . $model->file_foto_equipo->extension;
                $model->file_foto_equipo->saveAs($path . $filename);
                $model->foto_equipo = $filename;
            }

            // Foto número inventario
            if ($model->file_foto_numero_inventario) {
                $filename = uniqid() . '_' . $model->file_foto_numero_inventario->baseName . '.' . $model->file_foto_numero_inventario->extension;
                $model->file_foto_numero_inventario->saveAs($path . $filename);
                $model->foto_numero_inventario = $filename;
            }

            // Foto número serie
            if ($model->file_foto_numero_serie) {
                $filename = uniqid() . '_' . $model->file_foto_numero_serie->baseName . '.' . $model->file_foto_numero_serie->extension;
                $model->file_foto_numero_serie->saveAs($path . $filename);
                $model->foto_numero_serie = $filename;
            }

            $model->save(false);
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

    // Guardar nombres actuales
    $fotoEquipoActual = $model->foto_equipo;
    $fotoInventarioActual = $model->foto_numero_inventario;
    $fotoSerieActual = $model->foto_numero_serie;

    // listas
    $modelos = ArrayHelper::map(Modelos::find()->all(), 'id', 'descripcion');
    $estados = ArrayHelper::map(EstadoEquipo::find()->all(), 'id', 'descripcion');
    $marcas = ArrayHelper::map(Marcas::find()->all(), 'id', 'descripcion');
    $tiposEquipo = ArrayHelper::map(TipoEquipo::find()->all(), 'id', 'descripcion');
    $tiposAlta = ArrayHelper::map(TipoAlta::find()->all(), 'id', 'descripcion');

    if ($this->request->isPost && $model->load(Yii::$app->request->post())) {

        // FORMATO CORRECTO DE FECHA
        if ($model->fecha_alta) {
            $model->fecha_alta = str_replace('T', ' ', $model->fecha_alta) . ':00';
        }

        $path = Yii::getAlias('@frontend/web/uploads/equipos/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // ARCHIVOS NUEVOS
        $model->file_foto_equipo = UploadedFile::getInstance($model, 'file_foto_equipo');
        $model->file_foto_numero_inventario = UploadedFile::getInstance($model, 'file_foto_numero_inventario');
        $model->file_foto_numero_serie = UploadedFile::getInstance($model, 'file_foto_numero_serie');

        // Foto equipo
        if ($model->file_foto_equipo) {
            $filename = uniqid() . '_' . $model->file_foto_equipo->baseName . '.' . $model->file_foto_equipo->extension;
            $model->file_foto_equipo->saveAs($path . $filename);
            $model->foto_equipo = $filename;
        } else {
            $model->foto_equipo = $fotoEquipoActual;
        }

        // Foto num inventario
        if ($model->file_foto_numero_inventario) {
            $filename = uniqid() . '_' . $model->file_foto_numero_inventario->baseName . '.' . $model->file_foto_numero_inventario->extension;
            $model->file_foto_numero_inventario->saveAs($path . $filename);
            $model->foto_numero_inventario = $filename;
        } else {
            $model->foto_numero_inventario = $fotoInventarioActual;
        }

        // Foto num serie
        if ($model->file_foto_numero_serie) {
            $filename = uniqid() . '_' . $model->file_foto_numero_serie->baseName . '.' . $model->file_foto_numero_serie->extension;
            $model->file_foto_numero_serie->saveAs($path . $filename);
            $model->foto_numero_serie = $filename;
        } else {
            $model->foto_numero_serie = $fotoSerieActual;
        }

        $model->save(false);
        return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
        'model' => $model,
        'marcas' => $marcas,
        'modelos' => $modelos,
        'estados' => $estados,
        'tiposEquipo' => $tiposEquipo,
        'tiposAlta' => $tiposAlta,
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
     * Finds Equipos model based on ID.
     */
    protected function findModel($id)
    {
        if (($model = Equipos::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Acción para DepDrop (modelos según marca)
     */
    public function actionListModelos()
{
    Yii::$app->response->format = Response::FORMAT_JSON;

    $marca_id = Yii::$app->request->get('marca_id');

    if (!$marca_id) {
        return [];
    }

    $modelos = Modelos::find()
        ->where(['marcas_id' => $marca_id])
        ->all();

    $lista = [];
    foreach ($modelos as $m) {
        $lista[$m->id] = $m->descripcion;
    }

    return $lista;
}

}
