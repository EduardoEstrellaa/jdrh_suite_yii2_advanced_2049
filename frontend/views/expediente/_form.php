<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\InputHelper;
use common\assets\ExpedienteAsset;
use common\helpers\BooleanHelper;
use common\models\EntidadesFederativas;
use common\models\EstadosCiviles;
use common\models\Nacionalidades;
use common\models\TiposBecas;
use common\models\CatalogoDependenciasEconomicas;
use common\models\AlumDependeEconomicamente;
use common\models\AlumDependenEconomica;
use common\models\Dependientes;
use common\models\AlumTrabajo;
use common\models\AlumVivienda;
use common\models\CatalogoBienesVivienda;
use common\models\AlumTransportes;
use common\models\CatalogoTransportes;
use common\models\TiposViviendas;
use common\models\TiempoRecorridoTransporte;
use common\models\AlumEstadoSalud;
use common\models\AlumEnfermedadesCronicas;
use common\models\AlumAlergia;
use common\models\AlumServiciosSalud;
use common\models\AlumAsisteMedico;
use common\models\AlumAsisteDentista;
use common\models\AlumUsoAnteojos;
use common\models\ProblemasSalud;
use common\models\CatalogoProblemasSalud;
use common\models\CatalogoEnfermCronicas;
use common\models\CatalogoAlergias;
use common\models\CatalogoReaccionesAlergicas;
use common\models\CatalogoServiciosSalud;
use common\models\CatalogoUsoAnteojos;
use common\models\FrecuenciaTiempo;
use common\models\FrecuenciaVeces;
use common\models\TipoGravedad;
use common\models\CatalogoTratamientos;
use common\models\AlumTratamientos;
use common\models\Tratamientos;
use common\models\CatalogoLugaresComer;
use common\models\CatalogoAlimentos;
use common\models\AlumConsumoAlimentos;
use common\models\EnfermedadesCronicas;
use common\models\Alergias;
use common\models\VariasReaccionesAlergicas;
use kartik\daterange\DateRangePicker;
use kartik\checkbox\CheckboxX;
use yii\helpers\Url;
use yii\web\View;

ExpedienteAsset::register($this);

$this->title = 'Expediente';

$alumDependeEconomicamente = $alumDependeEconomicamente ?? new AlumDependeEconomicamente();
$alumDependenEconomica = $alumDependenEconomica ?? new AlumDependenEconomica();
$alumTrabajo = $alumTrabajo ?? new AlumTrabajo();
$alumVivienda = $alumVivienda ?? new AlumVivienda(['alumnos_id' => $alumno->id ?? null]);
$alumTransportes = $alumTransportes ?? new AlumTransportes(['alumnos_id' => $alumno->id ?? null]);
$catalogoDependenciasOptions = $catalogoDependenciasOptions ?? [];
$otroCatalogoDependenciaId = $otroCatalogoDependenciaId ?? null;
$dependientes = $dependientes ?? [];
$dependientesSeleccionados = $dependientesSeleccionados ?? [];
$dependientesOtro = $dependientesOtro ?? null;
$tiposViviendasMap = $tiposViviendasMap ?? [];
$tipoViviendaOtroId = $tipoViviendaOtroId ?? null;
$catalogoBienesOptions = $catalogoBienesOptions ?? [];
$catalogoBienOtroId = $catalogoBienOtroId ?? null;
$bienesSeleccionados = $bienesSeleccionados ?? [];
$bienesOtro = $bienesOtro ?? null;
$catalogoServiciosViviendaOptions = $catalogoServiciosViviendaOptions ?? [];
$catalogoServicioOtroId = $catalogoServicioOtroId ?? null;
$serviciosSeleccionados = $serviciosSeleccionados ?? [];
$serviciosOtro = $serviciosOtro ?? null;
$catalogoBienesPersonalesOptions = $catalogoBienesPersonalesOptions ?? [];
$bienesPersonalesSeleccionados = $bienesPersonalesSeleccionados ?? [];
$catalogoTransportesMap = $catalogoTransportesMap ?? CatalogoTransportes::dropdownOptions();
$tiemposRecorridoMap = $tiemposRecorridoMap ?? TiempoRecorridoTransporte::dropdownOptions();
$alumEstadoSalud = $alumEstadoSalud ?? new AlumEstadoSalud(['alumnos_id' => $alumno->id ?? null]);
$alumEnfermedadesCronicas = $alumEnfermedadesCronicas ?? new AlumEnfermedadesCronicas(['alumnos_id' => $alumno->id ?? null]);
$alumAlergia = $alumAlergia ?? new AlumAlergia(['alumnos_id' => $alumno->id ?? null]);
$alumServiciosSalud = $alumServiciosSalud ?? new AlumServiciosSalud(['alumnos_id' => $alumno->id ?? null]);
$alumAsisteMedico = $alumAsisteMedico ?? new AlumAsisteMedico(['alumnos_id' => $alumno->id ?? null]);
$alumAsisteDentista = $alumAsisteDentista ?? new AlumAsisteDentista(['alumnos_id' => $alumno->id ?? null]);
$alumUsoAnteojos = $alumUsoAnteojos ?? new AlumUsoAnteojos(['alumnos_id' => $alumno->id ?? null]);
$enfermedadesCronicas = $enfermedadesCronicas ?? [new EnfermedadesCronicas()];
$alergias = $alergias ?? [new Alergias()];
$problemasSalud = $problemasSalud ?? [new ProblemasSalud()];
$catalogoProblemasSaludMap = $catalogoProblemasSaludMap ?? CatalogoProblemasSalud::dropdownOptions();
$catalogoLugaresComerMap = $catalogoLugaresComerMap ?? CatalogoLugaresComer::dropdownOptions();
$catalogoLugarComerOtroId = $catalogoLugarComerOtroId ?? CatalogoLugaresComer::getOtroId();
$lugaresComerSeleccionados = $lugaresComerSeleccionados ?? [];
$lugarComerOtro = $lugarComerOtro ?? null;
$lugaresComerOtroMap = $lugaresComerOtroMap ?? [];
$catalogoAlimentosMap = $catalogoAlimentosMap ?? CatalogoAlimentos::dropdownOptions();
$frecuenciasVecesMap = $frecuenciasVecesMap ?? FrecuenciaVeces::dropdownOptions();
$consumoAlimentos = $consumoAlimentos ?? [new AlumConsumoAlimentos(['alumnos_id' => $alumno->id ?? null])];
$catalogoEnfermCronicasMap = $catalogoEnfermCronicasMap ?? CatalogoEnfermCronicas::dropdownOptions();
$catalogoAlergiasMap = $catalogoAlergiasMap ?? CatalogoAlergias::dropdownOptions();
$catalogoServiciosSaludMap = $catalogoServiciosSaludMap ?? CatalogoServiciosSalud::dropdownOptions();
$catalogoReaccionesAlergicasMap = $catalogoReaccionesAlergicasMap ?? CatalogoReaccionesAlergicas::dropdownOptions();
$catalogoUsoAnteojosMap = $catalogoUsoAnteojosMap ?? CatalogoUsoAnteojos::dropdownOptions();
$frecuenciasTiempoMap = $frecuenciasTiempoMap ?? FrecuenciaTiempo::dropdownOptions();
$tipoGravedadMap = $tipoGravedadMap ?? TipoGravedad::dropdownOptions();
$otroCatalogoProblemaId = $otroCatalogoProblemaId ?? CatalogoProblemasSalud::getOtroId();
$otroCatalogoEnfermCronicaId = $otroCatalogoEnfermCronicaId ?? CatalogoEnfermCronicas::getOtroId();
$alumnoId = (int)($alumno->id ?? 0);
$serviciosSaludSeleccionados = $serviciosSaludSeleccionados ?? [];
$enfermedadesCronicasSeleccionadas = $enfermedadesCronicasSeleccionadas ?? [];
$reaccionesAlergiasSeleccionadas = $reaccionesAlergiasSeleccionadas ?? [];
$usoAnteojosSeleccionados = $usoAnteojosSeleccionados ?? [];
$alumTratamientos = $alumTratamientos ?? new AlumTratamientos(['alumnos_id' => $alumno->id ?? null]);
$tratamientos = $tratamientos ?? [new Tratamientos()];
$catalogoTratamientosMap = $catalogoTratamientosMap ?? CatalogoTratamientos::dropdownOptions();

$tratamientosMap = [];
foreach ($tratamientos as $t) {
    $tratamientosMap[(int)$t->catalogo_tratamientos_id] = $t;
}

$this->registerCssFile('@web/css/expediente-form.css');
?>

<div class="expediente-form">

    <?php $form = ActiveForm::begin(['id' => 'expediente-form']); ?>

    <div class="expediente-card card border-0 mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">Completa tu expediente</h4>
                    <p class="text-muted mb-2">Avanza sección por sección; puedes guardar cuando termines.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-success-subtle text-success px-3 py-2">
                        <i class="fas fa-lock me-1"></i> Datos seguros
                    </span>
                    <span class="badge bg-info-subtle text-info px-3 py-2">
                        <i class="fas fa-clock me-1"></i> Tiempo estimado: 8-10 min
                    </span>
                </div>
            </div>
        </div>
    </div>

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

                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 1</span>
                        <div>
                            <div class="fw-semibold">Confirma tus datos institucionales.</div>
                            <div class="text-muted small">Solo lectura: revisa matrícula, plan y generación.</div>
                        </div>
                    </div>

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

                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 2</span>
                        <div>
                            <div class="fw-semibold">Completa tus datos personales y de contacto.</div>
                            <div class="text-muted small">Llena campos obligatorios y verifica teléfonos y correo.</div>
                        </div>
                    </div>

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
                    <!-- DATOS PERSONALES -->
                    <!-- ===================== -->
                    <h4 class="mb-3">
                        <i class="fas fa-address-card text-info"></i>
                        <span class="text-secondary">Datos Personales</span>
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
                    <!-- DATOS GENERALES -->
                    <!-- ===================== -->
                    <h4 class="mb-3 mt-4">
                        <i class="fas fa-info-circle text-primary"></i>
                        <span class="text-secondary">Datos Generales</span>
                    </h4>

                    <div class="row">
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $datosGenerales, 'tlf_personal', 'fa-phone', [
                                'inputOptions' => ['placeholder' => 'Teléfono personal...']
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $datosGenerales, 'tlf_emergencia', 'fa-phone-alt', [
                                'inputOptions' => ['placeholder' => 'Teléfono emergencia...']
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $datosGenerales, 'email_personal', 'fa-envelope', [
                                'inputOptions' => ['placeholder' => 'Email personal...']
                            ]) ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $datosGenerales,
                                'estados_civiles_id',
                                'fa-ring',
                                EstadosCiviles::getEstadosCivilesMap(),
                                ['options' => ['placeholder' => 'Estado civil...']]
                            ) ?>
                        </div>

                        <div class="col-md-4">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $datosGenerales,
                                'nacionalidades_id',
                                'fa-flag',
                                Nacionalidades::getNacionalidadesMap(),
                                ['options' => ['placeholder' => 'Nacionalidad...']]
                            ) ?>
                        </div>

                        <div class="col-md-4">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $datosGenerales,
                                'maya_hablante',
                                'fa-language',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Habla maya?'
                                ]
                            ) ?>
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

                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 3</span>
                        <div>
                            <div class="fw-semibold">Cuéntanos sobre tu familia.</div>
                            <div class="text-muted small">Nombres, apellidos y ocupaciones para padre y madre.</div>
                        </div>
                    </div>

                    <h5 class="mb-3 mt-2">
                        <i class="fas fa-user-friends text-primary"></i>
                        <span class="text-secondary">Datos del Padre</span>
                    </h5>

                    <div class="row">
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'padre_nombre', 'fa-male', [
                                'inputOptions' => ['placeholder' => 'Nombre del padre...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'padre_apellido_paterno', 'fa-signature', [
                                'inputOptions' => ['placeholder' => 'Apellido paterno...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'padre_apellido_materno', 'fa-signature', [
                                'inputOptions' => ['placeholder' => 'Apellido materno...']
                            ]) ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'padre_ocupacion', 'fa-briefcase', [
                                'inputOptions' => ['placeholder' => 'Ocupación del padre...']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumDatosFamiliares,
                                'padre_mayahablante',
                                'fa-language',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Habla maya?'
                                ]
                            ) ?>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">
                        <i class="fas fa-user-friends text-info"></i>
                        <span class="text-secondary">Datos de la Madre</span>
                    </h5>

                    <div class="row">
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'madre_nombre', 'fa-female', [
                                'inputOptions' => ['placeholder' => 'Nombre de la madre...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'madre_apellido_paterno', 'fa-signature', [
                                'inputOptions' => ['placeholder' => 'Apellido paterno...']
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'madre_apellido_materno', 'fa-signature', [
                                'inputOptions' => ['placeholder' => 'Apellido materno...']
                            ]) ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'madre_ocupacion', 'fa-briefcase', [
                                'inputOptions' => ['placeholder' => 'Ocupación de la madre...']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumDatosFamiliares,
                                'madre_mayahablante',
                                'fa-language',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Habla maya?'
                                ]
                            ) ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 4: BECAS -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingBecas">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBecas" aria-expanded="false" aria-controls="collapseBecas">
                    🎓 IV. INFORMACIÓN DE BECAS
                </button>
            </h2>
            <div id="collapseBecas" class="accordion-collapse collapse" aria-labelledby="headingBecas" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">

                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 4</span>
                        <div>
                            <div class="fw-semibold">Registra tu beca.</div>
                            <div class="text-muted small">Indica si cuentas con beca, su tipo y especifica si es otra.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumBecas,
                                'tiene_beca',
                                'fa-graduation-cap',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Tiene beca?',
                                    'options' => [
                                        'id' => 'alumbecas-tiene_beca'
                                    ]
                                ]
                            ) ?>
                        </div>

                        <div class="col-md-6" id="tipo-beca-container" style="display: none;">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumBecas,
                                'tipos_becas_id',
                                'fa-award',
                                TiposBecas::getTiposBecasMap(),
                                [
                                    'options' => [
                                        'placeholder' => 'Tipo de beca...',
                                        'id' => 'alumbecas-tipos_becas_id'
                                    ]
                                ]
                            ) ?>
                        </div>
                    </div>

                    <div class="row mt-3" id="otro-especificar-container" style="display: none;">
                        <div class="col-md-12">
                            <?= InputHelper::iconTextField($form, $alumBecas, 'otro_especificar', 'fa-edit', [
                                'inputOptions' => [
                                    'placeholder' => 'Especificar otro tipo de beca...',
                                    'id' => 'alumbecas-otro_especificar'
                                ]
                            ]) ?>
                        </div>
                    </div>

                    <?php
                    $this->registerJsFile('@web/js/expediente/expediente-becas.js', [
                        'depends' => [\yii\web\JqueryAsset::class],
                    ]);
                    ?>


                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 5: INFORMACIÓN DE HIJOS -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingHijos">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHijos" aria-expanded="false" aria-controls="collapseHijos">
                    👶 V. INFORMACIÓN DE HIJOS
                </button>
            </h2>

            <div id="collapseHijos" class="accordion-collapse collapse" aria-labelledby="headingHijos" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body row g-3">

                    <div class="section-intro mb-2 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 5</span>
                        <div>
                            <div class="fw-semibold">Declara si tienes hijos.</div>
                            <div class="text-muted small">Si respondes sí, captura los datos básicos de cada uno.</div>
                        </div>
                    </div>

                    <!-- Select tiene hijos -->
                    <div class="col-md-6">
                        <?= InputHelper::iconSelect2Field(
                            $form,
                            $alumInfoHijos,
                            'tiene_hijos',
                            'fa-baby',
                            BooleanHelper::options(),
                            [
                                'placeholder' => '¿Tiene hijos?',
                                'options' => ['id' => 'aluminfohijos-tiene_hijos']
                            ]
                        ) ?>
                    </div>

                    <!-- Cantidad de hijos -->
                    <div class="col-md-6 d-none" id="campo-cantidad-hijos">
                        <?= InputHelper::iconTextField(
                            $form,
                            $alumInfoHijos,
                            'cantidad_hijos',
                            'fa-hashtag',
                            [
                                'inputOptions' => [
                                    'placeholder' => '¿Cuántos hijos tiene?',
                                    'type' => 'number',
                                    'min' => 1,
                                    'max' => 10
                                ]
                            ]
                        ) ?>
                    </div>

                    <div class="col-12 d-none" id="contenedor-hijos">
                        <h5 class="mt-3">Información de cada hijo</h5>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-2">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido paterno</th>
                                        <th>Apellido materno</th>
                                        <th>Fecha de nacimiento</th>
                                        <th class="text-center" style="width:80px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-hijos">
                                    <?php foreach ($edadesHijos as $i => $hijo): ?>
                                        <tr class="hijo-item align-middle">
                                            <input type="hidden" name="EdadesHijos[<?= $i ?>][id]" value="<?= $hijo->id ?>">
                                            <td><?= InputHelper::iconFieldArray("EdadesHijos[$i][nombre]", $hijo->nombre, 'fa-user', '') ?></td>
                                            <td><?= InputHelper::iconFieldArray("EdadesHijos[$i][apellido_paterno]", $hijo->apellido_paterno, 'fa-user-tag', '') ?></td>
                                            <td><?= InputHelper::iconFieldArray("EdadesHijos[$i][apellido_materno]", $hijo->apellido_materno, 'fa-user-tag', '') ?></td>
                                            <td><?= InputHelper::iconFieldArray("EdadesHijos[$i][fecha_nacimiento]", $hijo->fecha_nacimiento, 'fa-calendar', '', ['inputOptions' => ['type' => 'date', 'placeholder' => '']]) ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-sm btn-eliminar-hijo">✖</button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>

                            </table>
                        </div>

                        <button type="button" class="btn btn-success btn-sm" id="btn-agregar-hijo">+ Agregar hijo</button>
                    </div>


                    <?php
                    $this->registerJsFile(
                        '@web/js/expediente/expediente-hijos.js',
                        ['depends' => [\yii\web\JqueryAsset::class]] // Si necesitas jQuery, sino puedes quitarlo
                    );
                    ?>


                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 6: SITUACIÓN SOCIOECONÓMICA -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSituacionSocioeconomica">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSituacionSocioeconomica" aria-expanded="false" aria-controls="collapseSituacionSocioeconomica">
                    💰 VI. SITUACIÓN SOCIOECONÓMICA
                </button>
            </h2>
            <div id="collapseSituacionSocioeconomica" class="accordion-collapse collapse" aria-labelledby="headingSituacionSocioeconomica" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 6</span>
                        <div>
                            <div class="fw-semibold">Situación económica y dependientes.</div>
                            <div class="text-muted small">Indica de quién dependes, si tienes dependientes y detalles de tu trabajo.</div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumDependeEconomicamente,
                                'catalogo_dependencias_economicas_id',
                                'fa-hand-holding-usd',
                                CatalogoDependenciasEconomicas::dropdownOptions(),
                                [
                                    'placeholder' => 'Selecciona de quien dependes',
                                    'id' => 'alumdependeeconomicamente-catalogo_dependencias_economicas_id',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6 <?= ($alumDependeEconomicamente->catalogo_dependencias_economicas_id ?? null) === $otroCatalogoDependenciaId ? '' : 'd-none' ?>" id="otro-dependencia-container">
                            <?= InputHelper::iconTextField(
                                $form,
                                $alumDependeEconomicamente,
                                'otro_especificar',
                                'fa-edit',
                                [
                                    'inputOptions' => [
                                        'placeholder' => 'Especifica otra dependencia economica...',
                                        'id' => 'alumdependeeconomicamente-otro_especificar'
                                    ]
                                ]
                            ) ?>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumDependenEconomica,
                                'tiene_dependientes',
                                'fa-user-friends',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Tiene dependientes?',
                                    'id' => 'alumdependeneconomica-tiene_dependientes',
                                ],
                                ['allowClear' => true]
                            ) ?>
                        </div>
                    </div>

                    <?php $mostrarDependientes = (int)($alumDependenEconomica->tiene_dependientes ?? 0) === 1; ?>
                    <div class="mt-3 <?= $mostrarDependientes ? '' : 'd-none' ?>" id="dependientes-section">
                        <div class="row g-2">
                            <?php foreach ($catalogoDependenciasOptions as $id => $nombre): ?>
                                <?php $checked = in_array((int)$id, $dependientesSeleccionados, true); ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input dependiente-checkbox"
                                            name="Dependientes[ids][]"
                                            value="<?= (int)$id ?>"
                                            id="dependiente-<?= (int)$id ?>"
                                            data-otro-id="<?= (int)$otroCatalogoDependenciaId ?>"
                                            <?= $checked ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="dependiente-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-2 <?= $otroCatalogoDependenciaId !== null && in_array((int)$otroCatalogoDependenciaId, $dependientesSeleccionados, true) ? '' : 'd-none' ?>" id="otro-dependiente-container">
                            <input type="text" name="Dependientes[otro_especificar]" id="dependientes-otro" class="form-control" placeholder="<?= Yii::t('app', 'Especificar otro...') ?>" value="<?= Html::encode($dependientesOtro ?? '') ?>">
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumTrabajo,
                                'tiene_trabajo',
                                'fa-briefcase',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Tiene trabajo?',
                                    'id' => 'alumtrabajo-tiene_trabajo',
                                ],
                                ['allowClear' => true]
                            ) ?>
                        </div>
                    </div>

                    <?php $mostrarTrabajo = (int)($alumTrabajo->tiene_trabajo ?? 0) === 1; ?>
                    <div class="row g-3 mt-2 <?= $mostrarTrabajo ? '' : 'd-none' ?>" id="trabajo-section">
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField(
                                $form,
                                $alumTrabajo,
                                'nombre_empresa',
                                'fa-building',
                                [
                                    'inputOptions' => [
                                        'placeholder' => 'Nombre de la empresa...',
                                        'id' => 'alumtrabajo-nombre_empresa',
                                    ],
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField(
                                $form,
                                $alumTrabajo,
                                'puesto_ocupacion',
                                'fa-user-tie',
                                [
                                    'inputOptions' => [
                                        'placeholder' => 'Puesto u ocupación...',
                                        'id' => 'alumtrabajo-puesto_ocupacion',
                                    ],
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField(
                                $form,
                                $alumTrabajo,
                                'horario_entrada',
                                'fa-clock',
                                [
                                    'inputOptions' => [
                                        'type' => 'time',
                                        'placeholder' => 'Hora de entrada',
                                        'id' => 'alumtrabajo-horario_entrada',
                                    ],
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconTextField(
                                $form,
                                $alumTrabajo,
                                'horario_salida',
                                'fa-clock',
                                [
                                    'inputOptions' => [
                                        'type' => 'time',
                                        'placeholder' => 'Hora de salida',
                                        'id' => 'alumtrabajo-horario_salida',
                                    ],
                                ]
                            ) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <!-- ===================== -->
        <!-- SECCIÓN 7: BIENES Y SERVICIOS DE LA VIVIENDA -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingBienesServiciosVivienda">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBienesServiciosVivienda" aria-expanded="false" aria-controls="collapseBienesServiciosVivienda">
                    <i class="fas fa-house-user me-2 text-success"></i> VII. BIENES Y SERVICIOS DE LA VIVIENDA
                </button>
            </h2>
            <div id="collapseBienesServiciosVivienda" class="accordion-collapse collapse" aria-labelledby="headingBienesServiciosVivienda" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 7</span>
                        <div>
                            <div class="fw-semibold">Tu vivienda y servicios.</div>
                            <div class="text-muted small">Cómo vives, tipo de vivienda y equipamiento disponible.</div>
                        </div>
                    </div>
                    <h4 class="mb-3">
                        <i class="fas fa-house-user text-success"></i>
                        <span class="text-secondary">Vivienda</span>
                    </h4>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumVivienda,
                                'vives_casa_padres',
                                'fa-people-roof',
                                BooleanHelper::options(),
                                [
                                    'options' => [
                                        'placeholder' => 'Vives con tus padres?',
                                        'id' => 'alumvivienda-vives_casa_padres',
                                    ],
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6 <?= ((int)($alumVivienda->vives_casa_padres ?? 1) === 0) ? '' : 'd-none' ?>" id="vivienda-otro-vives-container">
                            <?= InputHelper::iconTextField(
                                $form,
                                $alumVivienda,
                                'otro_especificar',
                                'fa-user-friends',
                                [
                                    'inputOptions' => [
                                        'placeholder' => 'Especifica con quien vives...',
                                        'id' => 'alumvivienda-otro_especificar',
                                    ],
                                ]
                            ) ?>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumVivienda,
                                'tipos_viviendas_id',
                                'fa-building',
                                $tiposViviendasMap,
                                [
                                    'options' => [
                                        'placeholder' => 'Selecciona el tipo de vivienda...',
                                        'id' => 'alumvivienda-tipos_viviendas_id',
                                    ],
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6 <?= ($tipoViviendaOtroId !== null && (int)($alumVivienda->tipos_viviendas_id ?? 0) === $tipoViviendaOtroId) ? '' : 'd-none' ?>" id="vivienda-otro-tipo-container">
                            <?= InputHelper::iconTextField(
                                $form,
                                $alumVivienda,
                                'otro_tipo_especificar',
                                'fa-edit',
                                [
                                    'inputOptions' => [
                                        'placeholder' => 'Especifica otro tipo de vivienda...',
                                        'id' => 'alumvivienda-otro_tipo_especificar',
                                    ],
                                ]
                            ) ?>
                        </div>
                    </div>

                    <?php
                    $mostrarOtroBien = $catalogoBienOtroId !== null && in_array((int)$catalogoBienOtroId, $bienesSeleccionados, true);
                    ?>
                    <div class="mt-4">
                        <h5 class="mb-2">
                            <i class="fas fa-couch text-info"></i>
                            <span class="text-secondary">Bienes con los que cuenta tu vivienda</span>
                        </h5>
                        <div class="row g-2">
                            <?php foreach ($catalogoBienesOptions as $id => $nombre): ?>
                                <?php $checked = in_array((int)$id, $bienesSeleccionados, true); ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input vivienda-bien-checkbox"
                                            name="ViviendaBienes[ids][]"
                                            value="<?= (int)$id ?>"
                                            id="vivienda-bien-<?= (int)$id ?>"
                                            data-otro-id="<?= (int)$catalogoBienOtroId ?>"
                                            <?= $checked ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="vivienda-bien-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-2 <?= $mostrarOtroBien ? '' : 'd-none' ?>" id="vivienda-bienes-otro-container">
                            <input type="text" name="ViviendaBienes[otro_especificar]" id="vivienda-bienes-otro" class="form-control" placeholder="Especifica otro bien..." value="<?= Html::encode($bienesOtro ?? '') ?>">
                        </div>
                    </div>
                    <?php
                    $mostrarOtroServicio = $catalogoServicioOtroId !== null && in_array((int)$catalogoServicioOtroId, $serviciosSeleccionados, true);
                    ?>
                    <div class="mt-4">
                        <h5 class="mb-2">
                            <i class="fas fa-plug text-warning"></i>
                            <span class="text-secondary">Servicios con los que cuenta tu vivienda</span>
                        </h5>
                        <div class="row g-2">
                            <?php foreach ($catalogoServiciosViviendaOptions as $id => $nombre): ?>
                                <?php $checked = in_array((int)$id, $serviciosSeleccionados, true); ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input vivienda-servicio-checkbox"
                                            name="ViviendaServicios[ids][]"
                                            value="<?= (int)$id ?>"
                                            id="vivienda-servicio-<?= (int)$id ?>"
                                            data-otro-id="<?= (int)$catalogoServicioOtroId ?>"
                                            <?= $checked ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="vivienda-servicio-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-2 <?= $mostrarOtroServicio ? '' : 'd-none' ?>" id="vivienda-servicios-otro-container">
                            <input
                                type="text"
                                name="ViviendaServicios[otro_especificar]"
                                id="vivienda-servicios-otro"
                                class="form-control"
                                placeholder="Especifica otro servicio..."
                                value="<?= Html::encode($serviciosOtro ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===================== -->
        <!-- SECCIÓN 8: BIENES PERSONALES -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingBienesPersonales">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBienesPersonales" aria-expanded="false" aria-controls="collapseBienesPersonales">
                    <i class="fas fa-user-check me-2 text-primary"></i> VIII. BIENES PERSONALES
                </button>
            </h2>
            <div id="collapseBienesPersonales" class="accordion-collapse collapse" aria-labelledby="headingBienesPersonales" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 8</span>
                        <div>
                            <div class="fw-semibold">Bienes personales.</div>
                            <div class="text-muted small">Selecciona con qué bienes personales cuentas.</div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <?php foreach ($catalogoBienesPersonalesOptions as $id => $nombre): ?>
                            <?php $checked = in_array((int)$id, $bienesPersonalesSeleccionados, true); ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input bienes-personales-checkbox"
                                        name="BienesPersonales[ids][]"
                                        value="<?= (int)$id ?>"
                                        id="bien-personal-<?= (int)$id ?>"
                                        <?= $checked ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="bien-personal-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===================== -->
        <!-- SECCIÓN 9: TRANSPORTE Y ACCESO -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTransporteAcceso">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTransporteAcceso" aria-expanded="false" aria-controls="collapseTransporteAcceso">
                    🚗 IX. TRANSPORTE Y ACCESO
                </button>
            </h2>
            <div id="collapseTransporteAcceso" class="accordion-collapse collapse" aria-labelledby="headingTransporteAcceso" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body row g-3">
                    <div class="section-intro mb-2 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 9</span>
                        <div>
                            <div class="fw-semibold">Transporte y tiempos.</div>
                            <div class="text-muted small">Cómo llegas a la escuela y cuánto tardas.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?= InputHelper::iconSelect2Field(
                            $form,
                            $alumTransportes,
                            'catalogo_transportes_id',
                            'fa-bus',
                            $catalogoTransportesMap,
                            ['placeholder' => 'Medio de transporte...']
                        ) ?>
                        <small class="text-muted">Selecciona cómo llegas a la escuela y cuánto tardas.</small>

                    </div>
                    <div class="col-md-6">
                        <?= InputHelper::iconSelect2Field(
                            $form,
                            $alumTransportes,
                            'tiempo_recorrido_transporte_id',
                            'fa-stopwatch',
                            $tiemposRecorridoMap,
                            ['placeholder' => 'Tiempo de recorrido...']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 10: SALUD -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSalud">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSalud" aria-expanded="false" aria-controls="collapseSalud">
                    ⚕️ X. SALUD
                </button>
            </h2>
            <div id="collapseSalud" class="accordion-collapse collapse" aria-labelledby="headingSalud" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 10</span>
                        <div>
                            <div class="fw-semibold">Información de salud.</div>
                            <div class="text-muted small">Problemas de salud, servicios, tratamientos y uso de anteojos.</div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumEstadoSalud,
                                'tuvo_problema_salud',
                                'fa-heartbeat',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Ha tenido problemas de salud?',
                                    'id' => 'alumestadosalud-tuvo_problema_salud',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumServiciosSalud,
                                'tiene_servicios_salud',
                                'fa-briefcase-medical',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Cuenta con servicios de salud?',
                                    'id' => 'alumserviciossalud-tiene_servicios_salud',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumEnfermedadesCronicas,
                                'padece_enfermedades_cronicas',
                                'fa-notes-medical',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Padeces enfermedades crónicas?',
                                    'id' => 'alumenfermedadescronicas-padece_enfermedades_cronicas',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumAlergia,
                                'padeces_alergias',
                                'fa-allergies',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Padeces alergias?',
                                    'id' => 'alumalergia-padeces_alergias',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumAsisteMedico,
                                'frecuencia_tiempo_id',
                                'fa-stethoscope',
                                $frecuenciasTiempoMap,
                                [
                                    'placeholder' => '¿Cada cuánto va al médico?',
                                    'id' => 'alumasistemedico-frecuencia_tiempo_id',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumAsisteDentista,
                                'frecuencia_tiempo_id',
                                'fa-tooth',
                                $frecuenciasTiempoMap,
                                [
                                    'placeholder' => '¿Cada cuánto va al dentista?',
                                    'id' => 'alumasistedentista-frecuencia_tiempo_id',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumUsoAnteojos,
                                'utilizas_anteojos',
                                'fa-glasses',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Utilizas anteojos?',
                                    'id' => 'alumusoanteojos-utilizas_anteojos',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumTratamientos,
                                'esta_en_tratamiento',
                                'fa-pills',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => '¿Estás en tratamiento actualmente?',
                                    'id' => 'alumtratamientos-esta_en_tratamiento',
                                ]
                            ) ?>
                        </div>
                    </div>

                    <?php
                    $enfermedadesCronicasSeleccionadas = $enfermedadesCronicasSeleccionadas ?? [];
                    ?>

                    <div id="salud-enfermedades-cronicas-container" class="<?= ((int)($alumEnfermedadesCronicas->padece_enfermedades_cronicas ?? 0) === 1) ? '' : 'd-none' ?>">
                        <div class="mt-3 mb-3">
                            <h5 class="mb-1">Enfermedades crónicas</h5>
                            <p class="text-muted small mb-0">Activa las enfermedades crónicas que padeces y detalla si aplica.</p>
                        </div>

                        <div id="lista-enfermedades-cronicas" class="row g-3">
                            <?php foreach ($catalogoEnfermCronicasMap as $id => $nombre): ?>
                                <?php
                                $id = (int)$id;
                                $enfermedad = $enfermedadesCronicasSeleccionadas[$id] ?? new EnfermedadesCronicas(['catalogo_enferm_cronicas_id' => $id]);
                                $seleccionada = isset($enfermedadesCronicasSeleccionadas[$id]);
                                $esOtro = $otroCatalogoEnfermCronicaId !== null && $id === (int)$otroCatalogoEnfermCronicaId;
                                ?>
                                <div class="col-lg-6 col-md-12">
                                    <div class="border rounded p-3 h-100 enfermedad-cronica-item" data-enfermedad-id="<?= $id ?>">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check form-switch">
                                                <input
                                                    class="form-check-input enfermedad-cronica-checkbox"
                                                    type="checkbox"
                                                    id="enfermedad-cronica-<?= $id ?>"
                                                    name="EnfermedadesCronicas[<?= $id ?>][selected]"
                                                    value="1"
                                                    <?= $seleccionada ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold" for="enfermedad-cronica-<?= $id ?>">
                                                    <?= Html::encode($nombre) ?>
                                                </label>
                                                <input type="hidden" name="EnfermedadesCronicas[<?= $id ?>][catalogo_enferm_cronicas_id]" value="<?= $id ?>">
                                            </div>
                                        </div>

                                        <?php if ($esOtro): ?>
                                            <div class="enfermedad-cronica-detalle mt-3 <?= $seleccionada ? '' : 'd-none' ?>">
                                                <label class="form-label fw-semibold" for="enfermedad-cronica-otro-<?= $id ?>">Especifica</label>
                                                <input
                                                    type="text"
                                                    class="form-control enfermedad-cronica-otro"
                                                    name="EnfermedadesCronicas[<?= $id ?>][otro_especificar]"
                                                    id="enfermedad-cronica-otro-<?= $id ?>"
                                                    placeholder="Describe la enfermedad"
                                                    value="<?= Html::encode($enfermedad->otro_especificar) ?>"
                                                    <?= $seleccionada ? '' : 'disabled' ?>>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php
                    $alergiasSeleccionadas = [];
                    foreach ($alergias as $alergia) {
                        $alergiasSeleccionadas[(int)$alergia->catalogo_alergias_id] = $alergia;
                    }
                    ?>

                    <div id="salud-alergias-container" class="<?= ((int)($alumAlergia->padeces_alergias ?? 0) === 1) ? '' : 'd-none' ?>">
                        <div class="mt-3 mb-3">
                            <h5 class="mb-1">Alergias</h5>
                            <p class="text-muted small mb-0">Activa las alergias que padeces y registra gravedad y reacciones.</p>
                        </div>

                        <div id="lista-alergias" class="row g-3">
                            <?php foreach ($catalogoAlergiasMap as $id => $nombre): ?>
                                <?php
                                $id = (int)$id;
                                $alergia = $alergiasSeleccionadas[$id] ?? new Alergias(['catalogo_alergias_id' => $id]);
                                $seleccionado = isset($alergiasSeleccionadas[$id]);
                                $reaccionesSeleccionadas = $reaccionesAlergiasSeleccionadas[$id] ?? [];
                                ?>
                                <div class="col-lg-6 col-md-12">
                                    <div class="border rounded p-3 h-100 alergia-item" data-alergia-id="<?= $id ?>">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check form-switch">
                                                <input
                                                    class="form-check-input alergia-checkbox"
                                                    type="checkbox"
                                                    id="alergia-<?= $id ?>"
                                                    name="Alergias[<?= $id ?>][selected]"
                                                    value="1"
                                                    <?= $seleccionado ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold" for="alergia-<?= $id ?>">
                                                    <?= Html::encode($nombre) ?>
                                                </label>
                                                <input type="hidden" name="Alergias[<?= $id ?>][catalogo_alergias_id]" value="<?= $id ?>">
                                            </div>
                                        </div>

                                        <div class="alergia-detalle mt-3 <?= $seleccionado ? '' : 'd-none' ?>">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alergia,
                                                "[{$id}]tipo_gravedad_id",
                                                'fa-exclamation-triangle',
                                                $tipoGravedadMap,
                                                [
                                                    'placeholder' => 'Gravedad...',
                                                    'class' => 'form-control alergia-gravedad',
                                                    'id' => "alergia-gravedad-{$id}",
                                                    'disabled' => !$seleccionado,
                                                ],
                                                ['allowClear' => true]
                                            )->label('Gravedad', ['class' => 'form-label fw-semibold']) ?>

                                            <div class="mt-2">
                                                <p class="text-muted small mb-2">Marca las reacciones que presentas.</p>
                                                <div class="row g-2">
                                                    <?php foreach ($catalogoReaccionesAlergicasMap as $reaccionId => $reaccionNombre): ?>
                                                        <?php $checked = in_array((int)$reaccionId, $reaccionesSeleccionadas, true); ?>
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input
                                                                    type="checkbox"
                                                                    class="form-check-input alergia-reaccion-checkbox"
                                                                    name="Alergias[<?= $id ?>][reacciones][]"
                                                                    value="<?= (int)$reaccionId ?>"
                                                                    id="alergia-<?= $id ?>-reaccion-<?= (int)$reaccionId ?>"
                                                                    <?= $checked ? 'checked' : '' ?>
                                                                    <?= $seleccionado ? '' : 'disabled' ?>>
                                                                <label class="form-check-label" for="alergia-<?= $id ?>-reaccion-<?= (int)$reaccionId ?>"><?= Html::encode($reaccionNombre) ?></label>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php
                    $problemasSaludSeleccionados = [];
                    foreach ($problemasSalud as $ps) {
                        $problemasSaludSeleccionados[(int)$ps->catalogo_problemas_salud_id] = $ps;
                    }
                    ?>

                    <div id="salud-problemas-container" class="<?= ((int)($alumEstadoSalud->tuvo_problema_salud ?? 0) === 1) ? '' : 'd-none' ?>">
                        <div class="mt-3 mb-3">
                            <h5 class="mb-1">Problemas de salud</h5>
                            <p class="text-muted small mb-0">Selecciona los problemas de salud que has tenido y su gravedad.</p>
                        </div>

                        <div id="lista-problemas" class="row g-3">
                            <?php foreach ($catalogoProblemasSaludMap as $id => $nombre): ?>
                                <?php
                                $id = (int)$id;
                                $problema = $problemasSaludSeleccionados[$id] ?? new ProblemasSalud(['catalogo_problemas_salud_id' => $id]);
                                $seleccionado = isset($problemasSaludSeleccionados[$id]);
                                $esOtro = $otroCatalogoProblemaId !== null && $id === (int)$otroCatalogoProblemaId;
                                $otroClasses = 'form-field mb-0 problema-otro ' . ($seleccionado && $esOtro ? '' : 'd-none');
                                ?>
                                <div class="col-lg-6 col-md-12">
                                    <div class="border rounded p-3 h-100 problema-item" data-problema-id="<?= $id ?>">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check form-switch">
                                                <input
                                                    class="form-check-input problema-checkbox"
                                                    type="checkbox"
                                                    id="problema-<?= $id ?>"
                                                    name="ProblemasSalud[<?= $id ?>][selected]"
                                                    value="1"
                                                    <?= $seleccionado ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold" for="problema-<?= $id ?>">
                                                    <?= Html::encode($nombre) ?>
                                                </label>
                                                <input type="hidden" name="ProblemasSalud[<?= $id ?>][catalogo_problemas_salud_id]" value="<?= $id ?>">
                                            </div>
                                        </div>

                                        <div class="problema-detalle mt-3 <?= $seleccionado ? '' : 'd-none' ?>">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $problema,
                                                "[{$id}]tipo_gravedad_id",
                                                'fa-exclamation-triangle',
                                                $tipoGravedadMap,
                                                [
                                                    'placeholder' => 'Gravedad...',
                                                    'class' => 'form-control problema-gravedad',
                                                    'id' => "problema-gravedad-{$id}",
                                                    'disabled' => !$seleccionado,
                                                ],
                                                ['allowClear' => true]
                                            )->label('Gravedad', ['class' => 'form-label fw-semibold']) ?>

                                            <?php if ($esOtro): ?>
                                                <?= InputHelper::iconTextField(
                                                    $form,
                                                    $problema,
                                                    "[{$id}]otro_especificar",
                                                    'fa-keyboard',
                                                    [
                                                        'options' => ['class' => trim($otroClasses)],
                                                        'inputOptions' => [
                                                            'placeholder' => 'Especifica el problema',
                                                            'class' => 'form-control problema-otro-input',
                                                            'id' => "problema-otro-{$id}",
                                                            'disabled' => !$seleccionado,
                                                        ],
                                                        'labelOptions' => ['class' => 'form-label fw-semibold'],
                                                    ]
                                                ) ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="salud-tratamientos-container" class="<?= ((int)($alumTratamientos->esta_en_tratamiento ?? 0) === 1) ? '' : 'd-none' ?>">
                        <div class="mt-3 mb-3">
                            <h5 class="mb-1">Tratamientos</h5>
                            <p class="text-muted small mb-0">Selecciona los tratamientos que sigues y especifica frecuencia y fechas.</p>
                        </div>

                        <div id="lista-tratamientos" class="row g-3">
                            <?php foreach ($catalogoTratamientosMap as $id => $nombre): ?>
                                <?php
                                $id = (int)$id;
                                $tratamiento = $tratamientosMap[$id] ?? new Tratamientos(['catalogo_tratamientos_id' => $id]);
                                $seleccionado = isset($tratamientosMap[$id]);
                                ?>
                                <div class="col-lg-6 col-md-12">
                                    <div class="border rounded p-3 h-100 tratamiento-item" data-tratamiento-id="<?= $id ?>">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check form-switch">
                                                <input
                                                    class="form-check-input tratamiento-checkbox"
                                                    type="checkbox"
                                                    id="tratamiento-<?= $id ?>"
                                                    name="Tratamientos[<?= $id ?>][selected]"
                                                    value="1"
                                                    <?= $seleccionado ? 'checked' : '' ?>>
                                                <label class="form-check-label fw-semibold" for="tratamiento-<?= $id ?>">
                                                    <?= Html::encode($nombre) ?>
                                                </label>
                                                <input type="hidden" name="Tratamientos[<?= $id ?>][catalogo_tratamientos_id]" value="<?= $id ?>">
                                            </div>
                                        </div>

                                        <div class="tratamiento-detalle mt-3 <?= $seleccionado ? '' : 'd-none' ?>">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $tratamiento,
                                                "[{$id}]frecuencia_tiempo_id",
                                                'fa-sync-alt',
                                                $frecuenciasTiempoMap,
                                                [
                                                    'placeholder' => 'Frecuencia...',
                                                    'class' => 'form-control tratamiento-frecuencia',
                                                    'id' => "tratamiento-frecuencia-{$id}",
                                                    'disabled' => !$seleccionado,
                                                ],
                                                ['allowClear' => true]
                                            )->label('Frecuencia', ['class' => 'form-label fw-semibold']) ?>

                                            <div class="form-field mb-3">
                                                <label class="form-label fw-semibold" for="tratamiento-rango-<?= $id ?>">Rango de fechas</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    <?= DateRangePicker::widget([
                                                        'model' => $tratamiento,
                                                        'attribute' => "[{$id}]fecha_inicio",
                                                        'startAttribute' => "[{$id}]fecha_inicio",
                                                        'endAttribute' => "[{$id}]fecha_fin",
                                                        'convertFormat' => true,
                                                        'value' => ($tratamiento->fecha_inicio && $tratamiento->fecha_fin)
                                                            ? Html::encode($tratamiento->fecha_inicio . ' - ' . $tratamiento->fecha_fin)
                                                            : '',
                                                        'options' => [
                                                            'id' => "tratamiento-rango-{$id}",
                                                            'class' => 'form-control tratamiento-rango',
                                                            'placeholder' => 'Selecciona rango...',
                                                            'readonly' => true,
                                                            'disabled' => !$seleccionado,
                                                        ],
                                                        'startInputOptions' => [
                                                            'class' => 'd-none tratamiento-fecha tratamiento-fecha-inicio',
                                                            'id' => "tratamiento-inicio-{$id}",
                                                        ],
                                                        'endInputOptions' => [
                                                            'class' => 'd-none tratamiento-fecha tratamiento-fecha-fin',
                                                            'id' => "tratamiento-fin-{$id}",
                                                        ],
                                                        'pluginOptions' => [
                                                            'locale' => [
                                                                'format' => 'Y-MM-DD',
                                                                'separator' => ' - ',
                                                            ],
                                                            'autoUpdateInput' => false,
                                                            'opens' => 'center',
                                                        ],
                                                        'pluginEvents' => [
                                                            'apply.daterangepicker' => "function(ev, picker) {
                                                                const val = picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD');
                                                                $(this).val(val);
                                                                $('#tratamiento-inicio-{$id}').val(picker.startDate.format('YYYY-MM-DD')).trigger('change');
                                                                $('#tratamiento-fin-{$id}').val(picker.endDate.format('YYYY-MM-DD')).trigger('change');
                                                            }",
                                                            'cancel.daterangepicker' => "function(ev, picker) {
                                                                $(this).val('');
                                                                $('#tratamiento-inicio-{$id}').val('').trigger('change');
                                                                $('#tratamiento-fin-{$id}').val('').trigger('change');
                                                            }",
                                                        ],
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="salud-anteojos-container" class="<?= ((int)($alumUsoAnteojos->utilizas_anteojos ?? 0) === 1) ? '' : 'd-none' ?>">
                        <h5 class="mt-3 mb-3">Tipo de uso de anteojos</h5>
                        <div class="row g-2">
                            <?php foreach ($catalogoUsoAnteojosMap as $id => $nombre): ?>
                                <?php $checked = in_array((int)$id, $usoAnteojosSeleccionados, true); ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-check">
                                        <input
                                            type="radio"
                                            class="form-check-input uso-anteojos-checkbox"
                                            name="UsoAnteojos[ids][]"
                                            value="<?= (int)$id ?>"
                                            id="uso-anteojos-<?= (int)$id ?>"
                                            <?= $checked ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="uso-anteojos-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="salud-servicios-container" class="<?= ((int)($alumServiciosSalud->tiene_servicios_salud ?? 0) === 1) ? '' : 'd-none' ?>">
                        <h5 class="mt-3 mb-3">Servicios de salud</h5>
                        <div class="row g-2">
                            <?php foreach ($catalogoServiciosSaludMap as $id => $nombre): ?>
                                <?php $checked = in_array((int)$id, $serviciosSaludSeleccionados, true); ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input servicio-salud-checkbox"
                                            name="ServiciosSalud[ids][]"
                                            value="<?= (int)$id ?>"
                                            id="servicio-salud-<?= (int)$id ?>"
                                            <?= $checked ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="servicio-salud-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

                <!-- ===================== -->
                <!-- SECCION 11: ALIMENTACION -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAlimentacion">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlimentacion" aria-expanded="false" aria-controls="collapseAlimentacion">
                    🍽️ XI. ALIMENTACION
                </button>
            </h2>
            <div id="collapseAlimentacion" class="accordion-collapse collapse" aria-labelledby="headingAlimentacion" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 11</span>
                        <div>
                            <div class="fw-semibold">Alimentacion y consumo.</div>
                            <div class="text-muted small">Lugares donde comes y frecuencia de tus alimentos.</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="mb-2">Lugares donde sueles comer</h5>
                        <p class="text-muted small mb-3">Selecciona todos los lugares aplicables.</p>
                        <?php
                        $catalogoLugaresComerOrdenados = [];
                        $catalogoLugaresComerOtros = [];
                        foreach ($catalogoLugaresComerMap as $idTmp => $nombreTmp) {
                            $nombreLimpioTmp = trim((string)$nombreTmp);
                            $esOtroTmp = ($catalogoLugarComerOtroId !== null && (int)$idTmp === (int)$catalogoLugarComerOtroId)
                                || mb_strtolower($nombreLimpioTmp, 'UTF-8') === 'otro';
                            if ($esOtroTmp) {
                                $catalogoLugaresComerOtros[$idTmp] = $nombreLimpioTmp;
                            } else {
                                $catalogoLugaresComerOrdenados[$idTmp] = $nombreLimpioTmp;
                            }
                        }
                        $catalogoLugaresComerOrdenados += $catalogoLugaresComerOtros;
                        ?>
                        <div class="row g-2">
                            <?php foreach ($catalogoLugaresComerOrdenados as $id => $nombreLimpio): ?>
                                <?php
                                $id = (int)$id;
                                  $checked = in_array($id, $lugaresComerSeleccionados, true);
                                  $esNombreOtro = mb_strtolower($nombreLimpio, 'UTF-8') === 'otro';
                                  $esOtro = ($catalogoLugarComerOtroId !== null && $id === (int)$catalogoLugarComerOtroId) || $esNombreOtro;
                                ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input lugar-comer-checkbox"
                                            name="AlumLugaresComer[<?= $id ?>][catalogo_lugares_comer_id]"
                                            value="<?= $id ?>"
                                            id="lugar-comer-<?= $id ?>"
                                            data-es-otro="<?= $esOtro ? '1' : '0' ?>"
                                            <?= $checked ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="lugar-comer-<?= $id ?>"><?= Html::encode($nombreLimpio) ?></label>
                                    </div>
                                    <?php if ($esOtro): ?>
                                        <div class="mt-2 lugar-comer-otro-container <?= $checked ? '' : 'd-none' ?>">
                                            <label class="form-label small text-muted" for="lugar-comer-otro"><?= Yii::t('app', 'Especifica otro lugar') ?></label>
                                            <input
                                                type="text"
                                                class="form-control lugar-comer-otro-input"
                                                name="AlumLugaresComer[<?= $id ?>][otro_especificar]"
                                                id="lugar-comer-otro"
                                                value="<?= Html::encode($lugaresComerOtroMap[$id] ?? $lugarComerOtro) ?>"
                                                <?= $checked ? '' : 'disabled' ?>>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php
                    $consumoMap = [];
                    foreach ($consumoAlimentos as $cons) {
                        $consumoMap[(int)$cons->catalogo_alimentos_id] = $cons;
                    }
                    ?>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                            <h5 class="mb-0">Consumo de alimentos</h5>
                            <span class="badge bg-info-subtle text-info fw-semibold px-3 py-2">Frecuencia semanal</span>
                        </div>
                        <p class="text-muted small mb-3">Ajusta la frecuencia de cada alimento de manera rápida.</p>
                        <div id="lista-consumo-alimentos" class="consumo-tiles">
                            <?php foreach ($catalogoAlimentosMap as $id => $nombre): ?>
                                <?php
                                $id = (int)$id;
                                $consumo = $consumoMap[$id] ?? new AlumConsumoAlimentos([
                                    'alumnos_id' => $alumnoId,
                                    'catalogo_alimentos_id' => $id,
                                ]);
                                ?>
                                <div class="consumo-alimento-item consumo-tile d-flex align-items-center gap-3 flex-wrap">
                                    <div class="d-flex align-items-center gap-2 consumo-tile-title">
                                <span class="consumo-marker" aria-hidden="true"></span>
                                        <span class="fw-semibold"><?= Html::encode($nombre) ?></span>
                                    </div>
                                    <div class="consumo-tile-select flex-grow-1">
                                        <?= InputHelper::iconSelect2Field(
                                            $form,
                                            $consumo,
                                            "[{$id}]frecuencia_veces_id",
                                            'fa-clock',
                                            $frecuenciasVecesMap,
                                            [
                                                'placeholder' => 'Frecuencia',
                                                'class' => 'form-control consumo-frecuencia-select',
                                                'id' => "consumo-frecuencia-{$id}",
                                            ],
                                            ['allowClear' => true]
                                        ) ?>
                                        <input type="hidden" name="AlumConsumoAlimentos[<?= $id ?>][catalogo_alimentos_id]" value="<?= $id ?>">
                                        <input type="hidden" name="AlumConsumoAlimentos[<?= $id ?>][alumnos_id]" value="<?= $alumnoId ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
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

$this->registerJsVar('DEPENDENCIA_OTRO_ID', $otroCatalogoDependenciaId);
$this->registerJsVar('TIPO_VIVIENDA_OTRO_ID', $tipoViviendaOtroId);
$this->registerJsVar('VIVIENDA_BIEN_OTRO_ID', $catalogoBienOtroId);
$this->registerJsVar('VIVIENDA_SERVICIO_OTRO_ID', $catalogoServicioOtroId);
$this->registerJsVar('PROBLEMA_OTRO_ID', $otroCatalogoProblemaId);
$this->registerJsVar('ENFERMEDAD_CRONICA_OTRO_ID', $otroCatalogoEnfermCronicaId);
$this->registerJsVar('LUGAR_COMER_OTRO_ID', $catalogoLugarComerOtroId);
$alumnoId = (int)($alumno->id ?? 0);
$this->registerJsFile(
    '@web/js/expediente/expediente-dependencia.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-dependientes.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-trabajo.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-vivienda.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-salud.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-alimentacion.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-focus-errors.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>
