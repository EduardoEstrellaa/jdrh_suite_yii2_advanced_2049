<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UnidadesEstudio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="unidades-estudio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'semestres_id')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion_general')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creditos')->textInput() ?>

    <?= $form->field($model, 'horas_semana')->textInput() ?>

    <?= $form->field($model, 'horas_semestre')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
