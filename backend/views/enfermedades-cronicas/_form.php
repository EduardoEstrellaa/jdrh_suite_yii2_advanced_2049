<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\EnfermedadesCronicas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="enfermedades-cronicas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'catalogo_enferm_cronicas_id')->textInput() ?>

    <?= $form->field($model, 'alum_enfermedades_cronicas_id')->textInput() ?>

    <?= $form->field($model, 'otro_especificas')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
