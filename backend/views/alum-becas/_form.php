<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AlumBecas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-becas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'tiene_beca')->textInput() ?>

    <?= $form->field($model, 'tipos_becas_id')->textInput() ?>

    <?= $form->field($model, 'otro_especificar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
