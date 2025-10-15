<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\DatosGenerales $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="datos-generales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'perfil_id')->textInput() ?>

    <?= $form->field($model, 'tlf_personal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tlf_emergencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_personal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maya_hablante')->textInput() ?>

    <?= $form->field($model, 'estados_civiles_id')->textInput() ?>

    <?= $form->field($model, 'nacionalidades_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
