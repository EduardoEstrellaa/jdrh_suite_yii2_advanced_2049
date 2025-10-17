<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AlumTrabajo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-trabajo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'tiene_trabajo')->textInput() ?>

    <?= $form->field($model, 'nombre_empresa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'puesto_ocupacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horario_entrada')->textInput() ?>

    <?= $form->field($model, 'horario_salida')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
