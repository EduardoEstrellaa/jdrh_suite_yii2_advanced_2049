<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\InputHelper;
use common\models\EntidadesFederativas;
use yii\helpers\Url;
use yii\web\View;

use common\assets\ExpedienteAsset;

ExpedienteAsset::register($this);

$this->title = 'Expediente';
?>

<div class="expediente-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ===================== -->
    <!-- 🎯 ACORDEÓN GENERAL -->
    <!-- ===================== -->
    <div class="accordion" id="expedienteAccordion">

        <!-- ===================== -->
        <!-- SECCIÓN 1: DATOS ACADÉMICOS -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDatosAcademicos">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosAcademicos" aria-expanded="true" aria-controls="collapseDatosAcademicos">
                    📚 I. DATOS ACADÉMICOS
                </button>
            </h2>
            <div id="collapseDatosAcademicos" class="accordion-collapse collapse show" aria-labelledby="headingDatosAcademicos" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Matrícula</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control bg-light" value="<?= Html::encode($alumno->matricula ?? 'No asignada') ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Plan de Licenciatura</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    <input type="text" class="form-control bg-light" value="<?= Html::encode($alumno->planLicenciaturas->licenciaturas->nombre ?? 'No asignado') ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Generación</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <input type="text" class="form-control bg-light" value="<?= Html::encode($alumno->generaciones->nombre ?? 'No asignada') ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 2: DATOS PERSONALES -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDatosPersonales">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosPersonales" aria-expanded="false" aria-controls="collapseDatosPersonales">
                    🧍‍♂️ II. DATOS PERSONALES
                </button>
            </h2>
            <div id="collapseDatosPersonales" class="accordion-collapse collapse" aria-labelledby="headingDatosPersonales" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">

                    <!-- ===================== -->
                    <!-- INFORMACIÓN BÁSICA -->
                    <!-- ===================== -->
                    <h4 class="mb-3 mt-2">
                        <i class="fas fa-user text-primary"></i>
                        <span class="text-secondary">Información Básica</span>
                    </h4>

                    <div class="row">
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $perfil, 'nombre', 'fa-user', [
                                'inputOptions' => [
                                    'class' => 'form-control bg-light',
                                    'readonly' => true,
                                    'value' => Html::encode($perfil->nombre ?? '')
                                ]
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $perfil, 'apellido', 'fa-user', [
                                'inputOptions' => [
                                    'class' => 'form-control bg-light',
                                    'readonly' => true,
                                    'value' => Html::encode($perfil->apellido ?? '')
                                ]
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $perfil, 'fecha_nacimiento', 'fa-calendar', [
                                'inputOptions' => [
                                    'class' => 'form-control bg-light',
                                    'readonly' => true,
                                    'value' => Html::encode($perfil->fecha_nacimiento ?? '')
                                ]
                            ]) ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField($form, $perfil, 'generoNombre', 'fa-venus-mars', [
                                'inputOptions' => [
                                    'class' => 'form-control bg-light',
                                    'readonly' => true,
                                    'value' => Html::encode($perfil->generoNombre ?? '')
                                ]
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField($form, $perfil, 'username', 'fa-at', [
                                'inputOptions' => [
                                    'class' => 'form-control bg-light',
                                    'readonly' => true,
                                    'value' => Html::encode($perfil->username ?? '')
                                ]
                            ]) ?>
                        </div>
                    </div>
                    <hr class="my-4">

                    <!-- ===================== -->
                    <!-- DATOS PERSONALES ADICIONALES -->
                    <!-- ===================== -->
                    <h4 class="mb-3">
                        <i class="fas fa-address-card text-info"></i>
                        <span class="text-secondary">Datos Personales Adicionales</span>
                    </h4>

                    <div class="row">
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $datosPersonales, 'curp', 'fa-id-card', [
                                'inputOptions' => ['placeholder' => 'CURP...']
                            ]) ?>
                            <div class="mt-1">
                                <small class="text-muted">
                                    <i class="fas fa-question-circle"></i>
                                    ¿No sabes tu CURP?
                                    <a href="https://www.gob.mx/curp/" target="_blank" class="text-primary">
                                        Consúltala aquí
                                    </a>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $datosPersonales, 'nss', 'fa-hospital-user', [
                                'inputOptions' => ['placeholder' => 'NSS...']
                            ]) ?>
                            <div class="mt-1">
                                <small class="text-muted">
                                    <i class="fas fa-question-circle"></i>
                                    ¿No sabes tu NSS?
                                    <a href="https://www.imss.gob.mx/tramites/imss02008" target="_blank" class="text-primary">
                                        Consúltala aquí
                                    </a>
                                </small>
                            </div>
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
                                $domiciliosActuales,
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
                                $domiciliosActuales,
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
                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'localidad', 'fa-map-pin', [
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
                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'calle', 'fa-road', [
                                'inputOptions' => ['placeholder' => 'Calle...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'numero_exterior', 'fa-door-open', [
                                'inputOptions' => ['placeholder' => 'Número exterior...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'numero_interior', 'fa-door-closed', [
                                'inputOptions' => ['placeholder' => 'Número interior...']
                            ]) ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'colonia', 'fa-map', [
                                'inputOptions' => ['placeholder' => 'Colonia...']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'codigo_postal', 'fa-envelope', [
                                'inputOptions' => ['placeholder' => 'Código postal...']
                            ]) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 3: DATOS FAMILIARES -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDatosFamiliares">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosFamiliares" aria-expanded="false" aria-controls="collapseDatosFamiliares">
                    👨‍👩‍👧 III. DATOS FAMILIARES
                </button>
            </h2>
            <div id="collapseDatosFamiliares" class="accordion-collapse collapse" aria-labelledby="headingDatosFamiliares" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Contenido de datos familiares próximamente...</p>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 4: SITUACIÓN SOCIOECONÓMICA -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSituacionSocioeconomica">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSituacionSocioeconomica" aria-expanded="false" aria-controls="collapseSituacionSocioeconomica">
                    💰 IV. SITUACIÓN SOCIOECONÓMICA
                </button>
            </h2>
            <div id="collapseSituacionSocioeconomica" class="accordion-collapse collapse" aria-labelledby="headingSituacionSocioeconomica" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Contenido de situación socioeconómica próximamente...</p>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 5: TRANSPORTE Y ACCESO -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTransporteAcceso">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTransporteAcceso" aria-expanded="false" aria-controls="collapseTransporteAcceso">
                    🚗 V. TRANSPORTE Y ACCESO
                </button>
            </h2>
            <div id="collapseTransporteAcceso" class="accordion-collapse collapse" aria-labelledby="headingTransporteAcceso" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Contenido de transporte y acceso próximamente...</p>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 6: SALUD -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSalud">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSalud" aria-expanded="false" aria-controls="collapseSalud">
                    ⚕️ VI. SALUD
                </button>
            </h2>
            <div id="collapseSalud" class="accordion-collapse collapse" aria-labelledby="headingSalud" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Contenido de salud próximamente...</p>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 7: ALIMENTACIÓN -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAlimentacion">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlimentacion" aria-expanded="false" aria-controls="collapseAlimentacion">
                    🍽️ VII. ALIMENTACIÓN
                </button>
            </h2>
            <div id="collapseAlimentacion" class="accordion-collapse collapse" aria-labelledby="headingAlimentacion" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Contenido de alimentación próximamente...</p>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 8: ACTIVIDAD FÍSICA Y DEPORTE -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingActividadFisica">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseActividadFisica" aria-expanded="false" aria-controls="collapseActividadFisica">
                    🏋️ VIII. ACTIVIDAD FÍSICA Y DEPORTE
                </button>
            </h2>
            <div id="collapseActividadFisica" class="accordion-collapse collapse" aria-labelledby="headingActividadFisica" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Contenido de actividad física y deporte próximamente...</p>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 9: HÁBITOS DE CONSUMO -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingHabitosConsumo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHabitosConsumo" aria-expanded="false" aria-controls="collapseHabitosConsumo">
                    🚬 IX. HÁBITOS DE CONSUMO
                </button>
            </h2>
            <div id="collapseHabitosConsumo" class="accordion-collapse collapse" aria-labelledby="headingHabitosConsumo" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Contenido de hábitos de consumo próximamente...</p>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 10: RECREACIÓN Y USO DEL TIEMPO LIBRE -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingRecreacion">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRecreacion" aria-expanded="false" aria-controls="collapseRecreacion">
                    💻 X. RECREACIÓN Y USO DEL TIEMPO LIBRE
                </button>
            </h2>
            <div id="collapseRecreacion" class="accordion-collapse collapse" aria-labelledby="headingRecreacion" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <p class="text-muted">Contenido de recreación y uso del tiempo libre próximamente...</p>
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


?>