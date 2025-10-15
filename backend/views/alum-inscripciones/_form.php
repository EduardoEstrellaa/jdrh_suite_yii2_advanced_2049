<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AlumInscripciones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-inscripciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'tipos_inscripciones_id')->textInput() ?>

    <?= $form->field($model, 'semestre_id')->textInput() ?>

    <?= $form->field($model, 'ciclos_escolares_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
