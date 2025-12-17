<?php

use common\models\Equipos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'Equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Equipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            // Fecha
            [
                'attribute' => 'fecha_alta',
                'format' => ['datetime', 'php:Y-m-d H:i'],
            ],

            'numero_inventario',
            'numero_serie',

            // Marca
            [
                'attribute' => 'marca_id',
                'value' => function ($model) {
                    return $model->marca ? $model->marca->descripcion : '(sin marca)';
                },
                'label' => 'Marca',
            ],

            // Modelo (FIX)
            [
                'attribute' => 'modelos_id',
                'value' => function ($model) {
                    return $model->modelo ? $model->modelo->descripcion : '(sin modelo)';
                },
                'label' => 'Modelo',
            ],

            // Tipo de Equipo
            [
                'attribute' => 'tipo_equipo_id',
                'value' => function ($model) {
                    return $model->tipoEquipo ? $model->tipoEquipo->descripcion : '(sin tipo)';
                },
                'label' => 'Tipo Equipo',
            ],

            // Tipo Alta
            [
                'attribute' => 'tipo_alta_id',
                'value' => function ($model) {
                    return $model->tipoAlta ? $model->tipoAlta->descripcion : '(sin alta)';
                },
                'label' => 'Tipo Alta',
            ],

            // Estado
            [
                'attribute' => 'estado_equipo_id',
                'value' => function ($model) {
                    return $model->estadoEquipo ? $model->estadoEquipo->descripcion : '(sin estado)';
                },
                'label' => 'Estado',
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Equipos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
