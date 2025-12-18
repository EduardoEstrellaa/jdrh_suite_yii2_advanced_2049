<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\InputHelper;
use common\models\Perfil;
use backend\assets\PerfilFormAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Perfil */
/* @var $form yii\widgets\ActiveForm */
/* @var $userList array Lista de usuarios sin perfil para el dropdown */

PerfilFormAsset::register($this);

?>

<div class="perfil-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ===================== -->
    <!-- SELECCIÓN DE USUARIO -->
    <!-- ===================== -->
    <?php if (isset($userList)): ?>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-user"></i> Selección de Usuario</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= InputHelper::iconSelect2Field(
                            $form,
                            $model,
                            'user_id',
                            'fa-users',
                            $userList,
                            [
                                'placeholder' => 'Seleccione un usuario',
                                'prompt' => '-- Seleccione un usuario --'
                            ]
                        ) ?>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Seleccione el usuario al que se le creará el perfil
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- ===================== -->
    <!-- DATOS PERSONALES -->
    <!-- ===================== -->
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
            $model->isNewRecord ? '<i class="fas fa-save"></i> Crear Perfil' : '<i class="fas fa-sync-alt"></i> Actualizar Perfil',
            ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>