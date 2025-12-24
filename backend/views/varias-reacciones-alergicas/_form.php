<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VariasReaccionesAlergicas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="varias-reacciones-alergicas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alergias_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_reacciones_alergicas_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
