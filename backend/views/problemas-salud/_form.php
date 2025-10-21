<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ProblemasSalud $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="problemas-salud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alum_estado_salud_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_problemas_salud_id')->textInput() ?>

    <?= $form->field($model, 'otro_especificar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_gravedad_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
