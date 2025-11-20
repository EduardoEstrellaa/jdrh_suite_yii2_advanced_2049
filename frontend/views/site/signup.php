<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\models\PlanLicenciaturas;
use common\models\Generaciones;
use frontend\models\Perfil;
use frontend\assets\PerfilFormAsset;
use common\helpers\InputHelper;

PerfilFormAsset::register($this);


$this->title = 'Registro de Estudiantes';

$generoLista = Perfil::getGeneroLista();
$planLicenciaturasLista = PlanLicenciaturas::getPlanesLicenciaturasMap();
$generacionesLista = Generaciones::getGeneracionesMap();
?>

<div class="site-signup">
    <div class="container">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <p class="text-center mb-5">Por favor completa los siguientes campos para registrarte:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'validationUrl' => ['site/validate-signup'],
            'validateOnSubmit' => true,
            'fieldConfig' => [
                'errorOptions' => ['class' => 'invalid-feedback']
            ]
        ]); ?>

        <div class="row equal-height-cards">

            <!-- DATOS DE USUARIO -->
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-circle"></i> Datos de Usuario
                        </h5>
                    </div>
                    <div class="card-body">

                        <?= InputHelper::iconTextField($form, $model, 'username', 'fa-user', [
                            'inputOptions' => ['autofocus' => true]
                        ])->textInput(); ?>

                        <?= InputHelper::iconTextField($form, $model, 'email', 'fa-envelope')->textInput(); ?>

                        <?= InputHelper::iconTextField($form, $model, 'password', 'fa-lock')
                            ->passwordInput(); ?>

                        <?= InputHelper::iconTextField($form, $model, 'password_repeat', 'fa-lock')
                            ->passwordInput(); ?>

                    </div>
                </div>
            </div>

            <!-- DATOS PERSONALES -->
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-id-card-alt"></i> Datos Personales
                        </h5>
                    </div>
                    <div class="card-body">

                        <?= InputHelper::iconTextField($form, $model, 'nombre', 'fa-address-card')->textInput(); ?>

                        <?= InputHelper::iconTextField($form, $model, 'apellido', 'fa-address-card')->textInput(); ?>

                        <?= InputHelper::iconTextField($form, $model, 'fecha_nacimiento', 'fa-calendar-alt')
                            ->input('date'); ?>

                        <?= InputHelper::iconSelect2Field(
                            $form,
                            $model,
                            'genero_id',
                            'fa-venus-mars',
                            $generoLista,
                            ['placeholder' => 'Selecciona tu género']
                        ); ?>

                    </div>
                </div>
            </div>

        </div>

        <!-- DATOS ACADÉMICOS -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-graduation-cap"></i> Datos Académicos
                        </h5>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <?= InputHelper::iconTextField($form, $model, 'matricula', 'fa-id-badge')->textInput(); ?>
                            </div>

                            <div class="col-md-4">
                                <?= InputHelper::iconSelect2Field(
                                    $form,
                                    $model,
                                    'plan_licenciaturas_id',
                                    'fa-book-open',
                                    $planLicenciaturasLista,
                                    ['placeholder' => 'Selecciona un plan']
                                ); ?>
                            </div>

                            <div class="col-md-4">
                                <?= InputHelper::iconSelect2Field(
                                    $form,
                                    $model,
                                    'generaciones_id',
                                    'fa-users',
                                    $generacionesLista,
                                    ['placeholder' => 'Selecciona una generación']
                                ); ?>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3 text-center">
            <?= Html::submitButton('<i class="fas fa-user-plus"></i> Registrarse', [
                'class' => 'btn btn-success btn-lg w-75'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>