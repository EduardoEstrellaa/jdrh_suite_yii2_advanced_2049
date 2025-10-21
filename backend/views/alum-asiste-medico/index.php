<?php

use backend\models\AlumAsisteMedico;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\search\AlumAsisteMedicoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Alum Asiste Medicos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-asiste-medico-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Alum Asiste Medico'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'frecuencia_tiempo_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AlumAsisteMedico $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
