<?php

use backend\models\AlumHabitosConsumo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\search\AlumHabitosConsumoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Alum Habitos Consumos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-habitos-consumo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Alum Habitos Consumo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alumnos_id',
            'fumas',
            'catalogo_cigarros_dia_id',
            'tomas_alcohol',
            //'frecuencia_veces_semana_id',
            //'tienes_adicciones',
            //'especificiar_adiccion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AlumHabitosConsumo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
