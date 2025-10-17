<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ViviendaServicios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vivienda-servicios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alum_vivienda_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_servicios_vivienda_id')->textInput() ?>

    <?= $form->field($model, 'otro_especificar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
