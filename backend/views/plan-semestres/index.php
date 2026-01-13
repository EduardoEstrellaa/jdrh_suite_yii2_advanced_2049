<?php

use common\models\PlanSemestres;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\search\PlanSemestresSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Plan Semestres');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-semestres-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Plan Semestres'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'planNombre',
                'label' => Yii::t('app', 'Plan de licenciatura'),
                'value' => 'planNombre',
            ],
            [
                'attribute' => 'semestreNombre',
                'label' => Yii::t('app', 'Semestre'),
                'value' => 'semestreNombre',
            ],
            [
                'attribute' => 'unidadNombre',
                'label' => Yii::t('app', 'Unidad de estudio'),
                'value' => 'unidadNombre',
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, PlanSemestres $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
