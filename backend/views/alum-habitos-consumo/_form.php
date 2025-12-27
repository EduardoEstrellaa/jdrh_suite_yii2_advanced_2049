<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AlumHabitosConsumo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-habitos-consumo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'fumas')->textInput() ?>

    <?= $form->field($model, 'catalogo_cigarros_dia_id')->textInput() ?>

    <?= $form->field($model, 'tomas_alcohol')->textInput() ?>

    <?= $form->field($model, 'frecuencia_veces_semana_id')->textInput() ?>

    <?= $form->field($model, 'tienes_adicciones')->textInput() ?>

    <?= $form->field($model, 'especificiar_adiccion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
