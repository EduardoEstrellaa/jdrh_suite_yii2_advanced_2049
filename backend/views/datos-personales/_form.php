<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\DatosPersonales $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="datos-personales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'perfil_id')->textInput() ?>

    <?= $form->field($model, 'curp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nss')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rfc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
