<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\HistorialTraslado $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="historial-traslado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipos_id')->textInput() ?>

    <?= $form->field($model, 'motivo_traslado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departamento_origen_id')->textInput() ?>

    <?= $form->field($model, 'departamento_destino_id')->textInput() ?>

    <?= $form->field($model, 'usuario_responsable')->textInput() ?>

    <?= $form->field($model, 'fecha_traslado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
