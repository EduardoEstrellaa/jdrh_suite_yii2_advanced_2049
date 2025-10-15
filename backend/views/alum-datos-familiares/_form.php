<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AlumDatosFamiliares $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-datos-familiares-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'padre_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'padre_apellido_paterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'padre_apellido_materno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'padre_ocupacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'padre_mayahablante')->textInput() ?>

    <?= $form->field($model, 'madre_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'madre_apellido_paterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'madre_apellido_materno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'madre_ocupacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'madre_mayahablante')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
