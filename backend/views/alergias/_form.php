<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Alergias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alergias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'alum_alergia_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_alergias_id')->textInput() ?>

    <?= $form->field($model, 'tipo_gravedad_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
