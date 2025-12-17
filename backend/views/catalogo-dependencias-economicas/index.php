<?php

use common\models\CatalogoDependenciasEconomicas;
use common\models\CategoriasDependencias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\search\CatalogoDependenciasEconomicasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Catalogo Dependencias Economicas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-dependencias-economicas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Catalogo Dependencias Economicas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descripcion',
            [
                'attribute' => 'categorias_dependencias_id',
                'value' => static function (CatalogoDependenciasEconomicas $model) {
                    return $model->categoriasDependencias->nombre ?? null;
                },
                'filter' => CategoriasDependencias::dropdownOptions(),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt' => Yii::t('app', 'Todas'),
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CatalogoDependenciasEconomicas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
