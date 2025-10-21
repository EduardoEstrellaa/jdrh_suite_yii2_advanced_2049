<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AlumRecreacionTiempo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-recreacion-tiempo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'sabes_usar_internet')->textInput() ?>

    <?= $form->field($model, 'tienes_acceso_internet')->textInput() ?>

    <?= $form->field($model, 'catalogo_lugares_acceso_principal_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
