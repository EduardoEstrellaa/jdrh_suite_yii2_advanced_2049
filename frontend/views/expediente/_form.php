<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\helpers\InputHelper;
use frontend\assets\AppAsset;
use common\models\EntidadesFederativas;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);

$this->title = 'Expediente';
?>

<div class="expediente-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ===================== -->
    <!-- 🎯 ACORDEÓN GENERAL -->
    <!-- ===================== -->
    <div class="accordion" id="expedienteAccordion">

        <!-- ===================== -->
        <!-- SECCIÓN 1: DATOS GENERALES -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingGeneral">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneral" aria-expanded="true" aria-controls="collapseGeneral">
                    <i class="fas fa-folder-open text-primary me-2"></i> Datos Generales del Estudiante
                </button>
            </h2>
            <div id="collapseGeneral" class="accordion-collapse collapse show" aria-labelledby="headingGeneral" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">

                    <!-- ===================== -->
                    <!-- DATOS PERSONALES -->
                    <!-- ===================== -->
                    <h4 class="mb-3 mt-2">
                        <i class="fas fa-user text-primary"></i>
                        <span class="text-secondary">Datos Personales</span>
                    </h4>

                    <div class="row">
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $datosPersonales, 'curp', 'fa-id-card', [
                                'inputOptions' => ['placeholder' => 'CURP...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $datosPersonales, 'nss', 'fa-hospital-user', [
                                'inputOptions' => ['placeholder' => 'NSS...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $datosPersonales, 'rfc', 'fa-user-tag', [
                                'inputOptions' => ['placeholder' => 'RFC...']
                            ]) ?>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- ===================== -->
                    <!-- LUGAR DE NACIMIENTO -->
                    <!-- ===================== -->
                    <h4 class="mb-3">
                        <i class="fas fa-birthday-cake text-warning"></i>
                        <span class="text-secondary">Lugar de Nacimiento</span>
                    </h4>

                    <div class="row">
                        <div class="col-md-4">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $lugaresNacimiento,
                                'entidades_federativas_id',
                                'fa-map-marker-alt',
                                EntidadesFederativas::getEntidadesFederativasMap(),
                                [
                                    'options' => [
                                        'id' => 'lugaresnacimiento-entidades_federativas_id',
                                        'placeholder' => 'Entidad federativa...'
                                    ]
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $lugaresNacimiento,
                                'municipios_id',
                                'fa-city',
                                [],
                                [
                                    'options' => [
                                        'id' => 'lugaresnacimiento-municipios_id',
                                        'placeholder' => 'Municipio...',
                                        'disabled' => true
                                    ]
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $lugaresNacimiento, 'localidad', 'fa-map-pin', [
                                'inputOptions' => [
                                    'placeholder' => 'Localidad...',
                                    'id' => 'lugaresnacimiento-localidad',
                                    'disabled' => true
                                ]
                            ]) ?>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- ===================== -->
                    <!-- DOMICILIO ACTUAL -->
                    <!-- ===================== -->
                    <h4 class="mb-3">
                        <i class="fas fa-home text-success"></i>
                        <span class="text-secondary">Domicilio Actual</span>
                    </h4>

                    <div class="row">
                        <div class="col-md-4">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $domicilioActual,
                                'entidades_federativas_id',
                                'fa-map-marker-alt',
                                EntidadesFederativas::getEntidadesFederativasMap(),
                                [
                                    'options' => [
                                        'id' => 'domiciliosactuales-entidades_federativas_id',
                                        'placeholder' => 'Entidad federativa...'
                                    ]
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $domicilioActual,
                                'municipios_id',
                                'fa-city',
                                [],
                                [
                                    'options' => [
                                        'id' => 'domiciliosactuales-municipios_id',
                                        'placeholder' => 'Municipio...',
                                        'disabled' => true
                                    ]
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $domicilioActual, 'localidad', 'fa-map-pin', [
                                'inputOptions' => [
                                    'placeholder' => 'Localidad...',
                                    'id' => 'domiciliosactuales-localidad',
                                    'disabled' => true
                                ]
                            ]) ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $domicilioActual, 'calle', 'fa-road', [
                                'inputOptions' => ['placeholder' => 'Calle...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $domicilioActual, 'numero_exterior', 'fa-door-open', [
                                'inputOptions' => ['placeholder' => 'Número exterior...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $domicilioActual, 'numero_interior', 'fa-door-closed', [
                                'inputOptions' => ['placeholder' => 'Número interior...']
                            ]) ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField($form, $domicilioActual, 'colonia', 'fa-map', [
                                'inputOptions' => ['placeholder' => 'Colonia...']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField($form, $domicilioActual, 'codigo_postal', 'fa-envelope', [
                                'inputOptions' => ['placeholder' => 'Código postal...']
                            ]) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 2: OTRO APARTADO (VACÍO) -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOtro">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOtro" aria-expanded="false" aria-controls="collapseOtro">
                    <i class="fas fa-file-alt text-info me-2"></i> Otro Apartado (Próximamente)
                </button>
            </h2>
            <div id="collapseOtro" class="accordion-collapse collapse" aria-labelledby="headingOtro" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Aquí podrás agregar más secciones del expediente, como datos escolares o familiares.</p>
                </div>
            </div>
        </div>

    </div> <!-- /accordion -->

    <!-- BOTONES -->
    <div class="form-group mt-5 text-center">
        <?= Html::submitButton('<i class="fas fa-save"></i> Guardar Expediente', ['class' => 'btn btn-success btn-lg me-3']) ?>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Cancelar', ['index'], ['class' => 'btn btn-secondary btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
// ===========================
// 🔗 Registrar JS externo
// ===========================
$municipiosUrl = Url::to(['expediente/municipios'], true);
$script = <<<JS
    window.MUNICIPIOS_URL = "{$municipiosUrl}";
JS;
$this->registerJs($script, View::POS_BEGIN);
$this->registerJsFile('@web/js/expediente-tutores.js', [
    'depends' => [\yii\web\JqueryAsset::class]
]);
?>