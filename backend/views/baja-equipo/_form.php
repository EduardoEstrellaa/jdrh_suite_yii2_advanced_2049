<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BajaEquipo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="baja-equipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipos_id')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tipo_baja_id')->textInput() ?>

    <?= $form->field($model, 'fecha_baja')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
