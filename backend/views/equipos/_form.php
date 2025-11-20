<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

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

    <!-- Marca -->
    <?= $form->field($model, 'marca_id')->widget(Select2::classname(), [
        'data' => $marcas,
        'options' => ['placeholder' => 'Seleccione una marca...'],
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

    <!-- Modelo -->
    <?= $form->field($model, 'modelos_id')->dropDownList(
        $modelos,
        ['prompt' => 'Seleccione un modelo...']
    ) ?>

    <!-- Tipo de Equipo -->
    <?= $form->field($model, 'tipo_equipo_id')->widget(Select2::classname(), [
        'data' => $tiposEquipo,
        'options' => ['placeholder' => 'Seleccione un tipo de equipo...'],
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

    <!-- Tipo de Alta -->
    <?= $form->field($model, 'tipo_alta_id')->widget(Select2::classname(), [
        'data' => $tiposAlta,
        'options' => ['placeholder' => 'Seleccione el tipo de alta...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <!-- Estado del Equipo -->
    <?= $form->field($model, 'estado_equipo_id')->widget(Select2::classname(), [
        'data' => $estados,
        'options' => ['placeholder' => 'Seleccione estado...'],
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
