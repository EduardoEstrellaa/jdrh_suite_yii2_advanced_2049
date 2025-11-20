<?php

use common\models\HistorialTraslado;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\HistorialTrasladoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Historial Traslados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historial-traslado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Historial Traslado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'equipos_id',
            'motivo_traslado',
            'departamento_origen_id',
            'departamento_destino_id',
            //'usuario_responsable',
            //'fecha_traslado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, HistorialTraslado $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
