<?php

use backend\models\DomiciliosActuales;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\search\DomiciliosActualesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Domicilios Actuales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domicilios-actuales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Domicilios Actuales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'perfil_id',
            'entidades_federativas_id',
            'municipios_id',
            'localidades_id',
            //'calle',
            //'numero_exterior',
            //'numero_interior',
            //'colonia',
            //'codigo_postal',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DomiciliosActuales $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
