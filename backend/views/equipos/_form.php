<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\Equipos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="equipos-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <!-- Marca -->
    <?= $form->field($model, 'marca_id')->widget(Select2::classname(), [
        'data' => $marcas,
        'options' => ['placeholder' => 'Seleccione una marca...'],
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

    <!-- Modelo -->
    <?= $form->field($model, 'modelos_id')->widget(Select2::classname(), [
        'data' => $modelos,
        'options' => ['placeholder' => 'Seleccione un modelo...'],
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

    <!-- Estado -->
    <?= $form->field($model, 'estado_equipo_id')->widget(Select2::classname(), [
        'data' => $estados,
        'options' => ['placeholder' => 'Seleccione un estado...'],
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

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
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

    <!-- Número de Inventario -->
    <?= $form->field($model, 'numero_inventario')->textInput(['maxlength' => true]) ?>

    <!-- Número de Serie -->
    <?= $form->field($model, 'numero_serie')->textInput(['maxlength' => true]) ?>

    <hr>
    <h4>📷 Fotografías del Equipo</h4>

    <!-- FOTO DEL EQUIPO -->
    <?= $form->field($model, 'file_foto_equipo')->fileInput() ?>

    <?php if (!$model->isNewRecord && $model->foto_equipo && $model->getImageUrl('foto_equipo')): ?>
        <p><strong>Foto actual del equipo:</strong></p>
        <img src="<?= $model->getImageUrl('foto_equipo') ?>"
             style="max-width: 200px; border: 1px solid #ccc; margin-bottom: 15px;">
    <?php endif; ?>

    <!-- FOTO NÚMERO INVENTARIO -->
    <?= $form->field($model, 'file_foto_numero_inventario')->fileInput() ?>

    <?php if (!$model->isNewRecord && $model->foto_numero_inventario && $model->getImageUrl('foto_numero_inventario')): ?>
        <p><strong>Foto actual del número inventario:</strong></p>
        <img src="<?= $model->getImageUrl('foto_numero_inventario') ?>"
             style="max-width: 200px; border: 1px solid #ccc; margin-bottom: 15px;">
    <?php endif; ?>

    <!-- FOTO NÚMERO SERIE -->
    <?= $form->field($model, 'file_foto_numero_serie')->fileInput() ?>

    <?php if (!$model->isNewRecord && $model->foto_numero_serie && $model->getImageUrl('foto_numero_serie')): ?>
        <p><strong>Foto actual del número de serie:</strong></p>
        <img src="<?= $model->getImageUrl('foto_numero_serie') ?>"
             style="max-width: 200px; border: 1px solid #ccc; margin-bottom: 15px;">
    <?php endif; ?>

    <hr>

    <!-- Observaciones -->
    <?= $form->field($model, 'observaciones')->textarea(['rows' => 4]) ?>

    <!-- Especificaciones -->
    <?= $form->field($model, 'especificaciones')->textarea(['rows' => 4]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


<?php
use yii\helpers\Url;

$ajaxUrl = Url::to(['equipos/list-modelos']);

$script = <<< JS
(function() {
    var \$marca = $('#equipos-marca_id');
    var \$modelo = $('#equipos-modelos_id');

    \$marca.on('change', function() {
        var marcaId = \$(this).val();

        \$modelo.html('<option value="">Cargando modelos...</option>').trigger('change');

        if (!marcaId) {
            \$modelo.html('<option value="">Seleccione un modelo...</option>').trigger('change');
            return;
        }

        \$.ajax({
            url: '{$ajaxUrl}',
            type: 'GET',
            dataType: 'json',
            data: { marca_id: marcaId },
            success: function(resp) {
                var opciones = '<option value="">Seleccione un modelo...</option>';
                if (!resp || Object.keys(resp).length === 0) {
                    opciones = '<option value="">No hay modelos para esta marca</option>';
                } else {
                    Object.keys(resp).forEach(function(key) {
                        opciones += '<option value="' + key + '">' + resp[key] + '</option>';
                    });
                }
                \$modelo.html(opciones).trigger('change');
            },
            error: function() {
                \$modelo.html('<option value="">Error al cargar modelos</option>').trigger('change');
            }
        });
    });

    if (\$marca.val()) {
        \$marca.trigger('change');
    }
})();
JS;

$this->registerJs($script);
?>

</div>
