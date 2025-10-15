<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PlanLicenciaturas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-licenciaturas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plan_estudios_id')->textInput() ?>

    <?= $form->field($model, 'licenciaturas_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
