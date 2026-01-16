<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EjercicioFisico $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ejercicio-fisico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alum_ejercicio_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_actividad_ejercicio_id')->textInput() ?>

    <?= $form->field($model, 'frecuencia_veces_semana_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
