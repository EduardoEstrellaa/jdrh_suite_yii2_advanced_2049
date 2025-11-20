<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Asignacion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asignacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipos_id')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_asignacion')->textInput() ?>

    <?= $form->field($model, 'departamentos_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
