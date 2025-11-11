<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\EquiposSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="equipos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_alta') ?>

    <?= $form->field($model, 'numero_inventario') ?>

    <?= $form->field($model, 'numero_serie') ?>

    <?= $form->field($model, 'foto_equipo') ?>

    <?php // echo $form->field($model, 'foto_numero_inventario') ?>

    <?php // echo $form->field($model, 'foto_numero_serie') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'especificaciones') ?>

    <?php // echo $form->field($model, 'modelos_id') ?>

    <?php // echo $form->field($model, 'tipo_equipo_id') ?>

    <?php // echo $form->field($model, 'tipo_alta_id') ?>

    <?php // echo $form->field($model, 'estado_equipo_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
