<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\AlumHabitosConsumoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-habitos-consumo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'alumnos_id') ?>

    <?= $form->field($model, 'fumas') ?>

    <?= $form->field($model, 'catalogo_cigarros_dia_id') ?>

    <?= $form->field($model, 'tomas_alcohol') ?>

    <?php // echo $form->field($model, 'frecuencia_veces_semana_id') ?>

    <?php // echo $form->field($model, 'tienes_adicciones') ?>

    <?php // echo $form->field($model, 'especificiar_adiccion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
