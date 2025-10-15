<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\UnidadesEstudioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="unidades-estudio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'semestres_id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion_general') ?>

    <?= $form->field($model, 'creditos') ?>

    <?php // echo $form->field($model, 'horas_semana') ?>

    <?php // echo $form->field($model, 'horas_semestre') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
