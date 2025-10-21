<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UsoAnteojos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="uso-anteojos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alum_uso_anteojos_id')->textInput() ?>

    <?= $form->field($model, 'catalogo_uso_anteojos_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
