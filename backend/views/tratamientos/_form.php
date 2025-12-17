<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Tratamientos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tratamientos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alum_tratamientos_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_tratamientos_id')->textInput() ?>

    <?= $form->field($model, 'frecuencia_tiempo_id')->textInput() ?>

    <?= $form->field($model, 'fecha_inicio')->textInput() ?>

    <?= $form->field($model, 'fecha_fin')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
