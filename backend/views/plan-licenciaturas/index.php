<?php

use common\models\Licenciaturas;
use common\models\PlanEstudios;
use common\models\PlanLicenciaturas;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\search\PlanLicenciaturasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$planOptions = ArrayHelper::map(
    PlanEstudios::find()->orderBy(['nombre' => SORT_ASC])->all(),
    'id',
    'nombre'
);

$licenciaturaOptions = ArrayHelper::map(
    Licenciaturas::find()->orderBy(['nombre' => SORT_ASC])->all(),
    'id',
    'nombre'
);

$this->title = Yii::t('app', 'Plan Licenciaturas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-licenciaturas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Plan Licenciaturas'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'label' => Yii::t('app', 'Plan de estudios'),
                'value' => 'planNombre',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'plan_estudios_id',
                    $planOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
            [
                'attribute' => 'licenciaturaEtiqueta',
                'label' => Yii::t('app', 'Licenciatura'),
                'value' => 'licenciaturaEtiqueta',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'licenciaturas_id',
                    $licenciaturaOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, PlanLicenciaturas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
