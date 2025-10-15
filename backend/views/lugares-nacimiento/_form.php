<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\LugaresNacimiento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lugares-nacimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'perfil_id')->textInput() ?>

    <?= $form->field($model, 'entidades_federativas_id')->textInput() ?>

    <?= $form->field($model, 'municipios_id')->textInput() ?>

    <?= $form->field($model, 'localidades_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
