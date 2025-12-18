<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\InputHelper;
use backend\assets\PerfilFormAsset;
use common\models\Perfil;



/* @var $this yii\web\View */
/* @var $model common\models\Perfil */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Mi Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Mi Perfil', 'url' => ['mi-perfil']];
$this->params['breadcrumbs'][] = $this->title;


PerfilFormAsset::register($this);

?>

<div class="perfil-create-mi-perfil">
    <?php $form = ActiveForm::begin(); ?>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-user-circle"></i> Datos Personales</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= InputHelper::iconTextField($form, $model, 'nombre', 'fa-user') ?>
                </div>
                <div class="col-md-6">
                    <?= InputHelper::iconTextField($form, $model, 'apellido', 'fa-user') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= InputHelper::iconTextField($form, $model, 'fecha_nacimiento', 'fa-calendar-alt', [
                        'inputOptions' => ['type' => 'date']
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $model,
                        'genero_id',
                        'fa-venus-mars',
                        $model->generoLista,
                        ['placeholder' => 'Seleccione el género']
                    ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group text-center mt-3">
        <?= Html::submitButton(
            '<i class="fas fa-save"></i> Crear Mi Perfil',
            ['class' => 'btn btn-success btn-lg']
        ) ?>
        <?= Html::a(
            '<i class="fas fa-arrow-left"></i> Cancelar',
            ['mi-perfil'],
            ['class' => 'btn btn-outline-secondary btn-lg']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>