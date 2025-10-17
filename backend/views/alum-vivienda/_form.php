<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AlumVivienda $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-vivienda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'vives_casa_padres')->textInput() ?>

    <?= $form->field($model, 'otro_especificar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipos_viviendas_id')->textInput() ?>

    <?= $form->field($model, 'otro_tipo_especificar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
