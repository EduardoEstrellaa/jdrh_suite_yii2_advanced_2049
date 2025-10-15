<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AsignacionesTutores $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asignaciones-tutores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'perfil_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
