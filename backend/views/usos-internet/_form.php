<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UsosInternet $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usos-internet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alum_recreacion_tiempo_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_usos_internet_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
