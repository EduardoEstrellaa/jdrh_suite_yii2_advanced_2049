<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TiempoRecorridoTransporte $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tiempo-recorrido-transporte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rango_tiempo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
