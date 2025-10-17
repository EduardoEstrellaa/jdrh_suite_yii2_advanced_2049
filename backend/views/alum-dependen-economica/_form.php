<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AlumDependenEconomica $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alum-dependen-economica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alumnos_id')->textInput() ?>

    <?= $form->field($model, 'tiene_dependientes')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
