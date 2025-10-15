<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AsignacionesAlumnosGrupos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asignaciones-alumnos-grupos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'asignaciones_grupos_id')->textInput() ?>

    <?= $form->field($model, 'alum_inscripciones_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
