<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\AlumDatosFamiliaresSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-datos-familiares-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'alumnos_id') ?>

    <?= $form->field($model, 'padre_nombre') ?>

    <?= $form->field($model, 'padre_apellido_paterno') ?>

    <?= $form->field($model, 'padre_apellido_materno') ?>

    <?php // echo $form->field($model, 'padre_ocupacion') ?>

    <?php // echo $form->field($model, 'padre_mayahablante') ?>

    <?php // echo $form->field($model, 'madre_nombre') ?>

    <?php // echo $form->field($model, 'madre_apellido_paterno') ?>

    <?php // echo $form->field($model, 'madre_apellido_materno') ?>

    <?php // echo $form->field($model, 'madre_ocupacion') ?>

    <?php // echo $form->field($model, 'madre_mayahablante') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
