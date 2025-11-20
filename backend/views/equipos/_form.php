<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Equipos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="equipos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_alta')->textInput() ?>

    <?= $form->field($model, 'numero_inventario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_serie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_equipo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'foto_numero_inventario')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'foto_numero_serie')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'especificaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'modelos_id')->textInput() ?>

    <?= $form->field($model, 'tipo_equipo_id')->textInput() ?>

    <?= $form->field($model, 'tipo_alta_id')->textInput() ?>

    <?= $form->field($model, 'estado_equipo_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
