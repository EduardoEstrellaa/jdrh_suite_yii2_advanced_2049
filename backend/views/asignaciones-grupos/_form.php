<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AsignacionesGrupos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asignaciones-grupos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'semestres_id')->textInput() ?>

    <?= $form->field($model, 'ciclos_escolares_id')->textInput() ?>

    <?= $form->field($model, 'grupos_id')->textInput() ?>

    <?= $form->field($model, 'asignaciones_tutores_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
