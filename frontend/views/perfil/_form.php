<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\helpers\InputHelper;
use frontend\assets\AppAsset;
use common\models\PlanLicenciaturas;
use common\models\Generaciones;

/* @var $this yii\web\View */
/* @var $model frontend\models\Perfil */
/* @var $alumno common\models\Alumnos */
/* @var $form yii\widgets\ActiveForm */

AppAsset::register($this);

// Listas para dropdowns
$planLicenciaturasLista = PlanLicenciaturas::getPlanesLicenciaturasMap();
$generacionesLista = Generaciones::getGeneracionesMap();

?>

<div class="perfil-form container">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ===================== -->
    <!-- DATOS PERSONALES -->
    <!-- ===================== -->
    <div class="card shadow-sm mb-4">
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

    <!-- ===================== -->
    <!-- DATOS ACADÉMICOS -->
    <!-- ===================== -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-graduation-cap"></i> Datos Académicos</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?= InputHelper::iconTextField($form, $alumno, 'matricula', 'fa-id-card', [
                        'inputOptions' => ['placeholder' => 'Ingresa tu matrícula...']
                    ]) ?>

                </div>

                <div class="col-md-4">
                    <?= InputHelper::iconSelect2Field($form, $alumno, 'plan_licenciaturas_id', 'fa-book', $planLicenciaturasLista, [
                        'placeholder' => 'Selecciona tu plan de licenciatura...'
                    ]) ?>

                </div>

                <div class="col-md-4">
                    <?= InputHelper::iconSelect2Field($form, $alumno, 'generaciones_id', 'fa-users', $generacionesLista, [
                        'placeholder' => 'Selecciona tu generación...'
                    ]) ?>

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