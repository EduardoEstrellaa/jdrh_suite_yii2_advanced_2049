<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Organizaciones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organizaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alum_organizacion_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_organizaciones_id')->textInput() ?>

    <?= $form->field($model, 'otra_organizacion_especificar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
