<?php

use backend\models\AlumDatosFamiliares;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\search\AlumDatosFamiliaresSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Alum Datos Familiares');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-datos-familiares-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Alum Datos Familiares'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'padre_nombre',
            'padre_apellido_paterno',
            'padre_apellido_materno',
            //'padre_ocupacion',
            //'padre_mayahablante',
            //'madre_nombre',
            //'madre_apellido_paterno',
            //'madre_apellido_materno',
            //'madre_ocupacion',
            //'madre_mayahablante',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AlumDatosFamiliares $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
