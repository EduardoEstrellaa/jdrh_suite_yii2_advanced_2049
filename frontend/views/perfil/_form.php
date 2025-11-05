<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\helpers\FormHelper;
use frontend\assets\AppAsset;


/* @var $this yii\web\View */
/* @var $model frontend\models\Perfil */
/* @var $form yii\widgets\ActiveForm */

AppAsset::register($this);

?>

<div class="perfil-form container">

    <?php $form = ActiveForm::begin(); ?>

    <?= FormHelper::inputWithIcon($form, $model, 'nombre', 'fas fa-user') ?>

    <?= FormHelper::inputWithIcon($form, $model, 'apellido', 'fas fa-user') ?>

    <?= FormHelper::inputWithIcon($form, $model, 'fecha_nacimiento', 'fas fa-calendar-alt', ['type' => 'date']) ?>

    <?= FormHelper::inputWithIcon($form, $model, 'genero_id', 'fas fa-venus-mars', [
        'select2' => [
            'data' => $model->generoLista,
            'placeholder' => 'Seleccione el género'
        ]
    ]) ?>

    <div class="form-group text-center mt-3">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', [
            'class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>