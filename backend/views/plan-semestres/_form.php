<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PlanSemestres $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-semestres-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plan_licenciatura_id')->textInput() ?>

    <?= $form->field($model, 'semestres_id')->textInput() ?>

    <?= $form->field($model, 'unidades_estudio_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
