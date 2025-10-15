<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\AlumInscripcionesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-inscripciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'alumnos_id') ?>

    <?= $form->field($model, 'tipos_inscripciones_id') ?>

    <?= $form->field($model, 'semestre_id') ?>

    <?= $form->field($model, 'ciclos_escolares_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
