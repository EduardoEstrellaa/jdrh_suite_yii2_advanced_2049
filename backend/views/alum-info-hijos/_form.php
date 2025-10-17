<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AlumInfoHijos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-info-hijos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'tiene_hijos')->textInput() ?>

    <?= $form->field($model, 'cantidad_hijos')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
