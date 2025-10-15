<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\DomiciliosActuales $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="domicilios-actuales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'perfil_id')->textInput() ?>

    <?= $form->field($model, 'entidades_federativas_id')->textInput() ?>

    <?= $form->field($model, 'municipios_id')->textInput() ?>

    <?= $form->field($model, 'localidades_id')->textInput() ?>

    <?= $form->field($model, 'calle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_exterior')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_interior')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colonia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_postal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
