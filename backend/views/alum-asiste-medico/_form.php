<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AlumAsisteMedico $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-asiste-medico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'frecuencia_tiempo_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
