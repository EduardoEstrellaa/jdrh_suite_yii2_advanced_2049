<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\BajaEquipoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="baja-equipo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'equipos_id') ?>

    <?= $form->field($model, 'observaciones') ?>

    <?= $form->field($model, 'tipo_baja_id') ?>

    <?= $form->field($model, 'fecha_baja') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
