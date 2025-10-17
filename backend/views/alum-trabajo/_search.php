<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\AlumTrabajoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-trabajo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'alumnos_id') ?>

    <?= $form->field($model, 'tiene_trabajo') ?>

    <?= $form->field($model, 'nombre_empresa') ?>

    <?= $form->field($model, 'puesto_ocupacion') ?>

    <?php // echo $form->field($model, 'horario_entrada') ?>

    <?php // echo $form->field($model, 'horario_salida') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
