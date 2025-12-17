<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Marcas;

/** @var yii\web\View $this */
/** @var common\models\Modelos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="modelos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marcas_id')->dropDownList(
        ArrayHelper::map(Marcas::find()->all(), 'id', 'descripcion'),
        ['prompt' => 'Seleccione una marca']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
$script = <<<JS
$('#equipos-marca_id').on('change', function() {
    var marcaId = $(this).val();

    $.ajax({
        url: 'index.php?r=equipos/list-modelos&id=' + marcaId,
        method: 'GET',
        success: function(data) {
            $('#equipos-modelos_id').html(data);
        }
    });
});
JS;

$this->registerJs($script);
?>


</div>
