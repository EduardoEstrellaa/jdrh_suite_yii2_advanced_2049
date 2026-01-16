<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AlumConsumoAlimentos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-consumo-alimentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_alimentos_id')->textInput() ?>

    <?= $form->field($model, 'frecuencia_veces_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
