<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Marca;

/** @var yii\web\View $this */
/** @var common\models\Modelos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="modelos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_marca')->dropDownList(
        ArrayHelper::map(Marca::find()->all(), 'id_marca', 'descripcion'),
        ['prompt' => 'Seleccione una marca']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
