<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\HistorialTrasladoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="historial-traslado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'equipos_id') ?>

    <?= $form->field($model, 'motivo_traslado') ?>

    <?= $form->field($model, 'departamento_origen_id') ?>

    <?= $form->field($model, 'departamento_destino_id') ?>

    <?php // echo $form->field($model, 'usuario_responsable') ?>

    <?php // echo $form->field($model, 'fecha_traslado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
