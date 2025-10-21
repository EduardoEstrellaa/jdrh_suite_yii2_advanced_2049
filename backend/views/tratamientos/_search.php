<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\TratamientosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tratamientos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'alum_tratamientos_id') ?>

    <?= $form->field($model, 'catalogo_tratamientos_id') ?>

    <?= $form->field($model, 'frecuencia_tiempo_id') ?>

    <?= $form->field($model, 'fecha_inicio') ?>

    <?php // echo $form->field($model, 'fecha_fin') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
