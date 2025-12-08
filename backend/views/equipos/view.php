<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Equipo #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="equipos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que deseas eliminar el equipo?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'id',
            'fecha_alta',
            'numero_inventario',
            'numero_serie',

            [
                'label' => 'Marca',
                'value' => $model->marca ? $model->marca->descripcion : 'No definido',
            ],
            [
                'label' => 'Modelo',
                'value' => $model->modelo ? $model->modelo->descripcion : 'No definido',
            ],
            [
                'label' => 'Tipo de Equipo',
                'value' => $model->tipoEquipo ? $model->tipoEquipo->descripcion : 'No definido',
            ],
            [
                'label' => 'Tipo de Alta',
                'value' => $model->tipoAlta ? $model->tipoAlta->descripcion : 'No definido',
            ],
            [
                'label' => 'Estado del Equipo',
                'value' => $model->estadoEquipo ? $model->estadoEquipo->descripcion : 'No definido',
            ],

            [
                'attribute' => 'foto_equipo',
                'format' => 'html',
                'value' => $model->getImageUrl('foto_equipo')
                    ? Html::img($model->getImageUrl('foto_equipo'), ['style' => 'max-width:200px'])
                    : 'Sin foto',
            ],

            [
                'attribute' => 'foto_numero_inventario',
                'format' => 'html',
                'value' => $model->getImageUrl('foto_numero_inventario')
                    ? Html::img($model->getImageUrl('foto_numero_inventario'), ['style' => 'max-width:200px'])
                    : 'Sin foto',
            ],

            [
                'attribute' => 'foto_numero_serie',
                'format' => 'html',
                'value' => $model->getImageUrl('foto_numero_serie')
                    ? Html::img($model->getImageUrl('foto_numero_serie'), ['style' => 'max-width:200px'])
                    : 'Sin foto',
            ],

            'observaciones:ntext',
            'especificaciones:ntext',
        ],
    ]) ?>

</div>
