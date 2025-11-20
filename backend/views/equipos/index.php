<?php

use common\models\Equipos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\EquiposSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Equipos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_alta',
            'numero_inventario',
            'numero_serie',
            'foto_equipo:ntext',
            //'foto_numero_inventario:ntext',
            //'foto_numero_serie:ntext',
            //'observaciones:ntext',
            //'especificaciones:ntext',
            //'modelos_id',
            //'tipo_equipo_id',
            //'tipo_alta_id',
            //'estado_equipo_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Equipos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
