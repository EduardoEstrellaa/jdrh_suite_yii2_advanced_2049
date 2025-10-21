<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Deportes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="deportes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alum_deportes_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_deportes_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
