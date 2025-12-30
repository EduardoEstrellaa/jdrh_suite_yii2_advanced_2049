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
use common\models\CatalogoActividadEjercicio;
use common\models\CatalogoDeportes;
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
use common\models\FrecuenciaVecesSemana;
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
use common\models\AlumDeportes;
use common\models\AlumEjercicio;
use common\models\AlumHabitosConsumo;
use common\models\CatalogoCigarrosDia;
use common\models\EjercicioFisico;
use common\models\AlumRecreacionTiempo;
use common\models\CatalogoLugaresAccesoPrincipal;
use common\models\CatalogoUsosInternet;
use common\models\AlumOrganizacion;
use common\models\CatalogoOrganizaciones;
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
$alumHabitosConsumo = $alumHabitosConsumo ?? new AlumHabitosConsumo(['alumnos_id' => $alumno->id ?? null]);
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
$alumDeportes = $alumDeportes ?? new AlumDeportes(['alumnos_id' => $alumno->id ?? null]);
$alumEjercicio = $alumEjercicio ?? new AlumEjercicio(['alumnos_id' => $alumno->id ?? null]);
$catalogoDeportesMap = $catalogoDeportesMap ?? CatalogoDeportes::dropdownOptions();
$catalogoActividadesEjercicioMap = $catalogoActividadesEjercicioMap ?? CatalogoActividadEjercicio::dropdownOptions();
$frecuenciasVecesSemanaMap = $frecuenciasVecesSemanaMap ?? FrecuenciaVecesSemana::dropdownOptions();
$catalogoCigarrosDiaMap = $catalogoCigarrosDiaMap ?? CatalogoCigarrosDia::dropdownOptions();
$alumRecreacionTiempo = $alumRecreacionTiempo ?? new AlumRecreacionTiempo(['alumnos_id' => $alumno->id ?? null]);
$catalogoLugaresAccesoMap = $catalogoLugaresAccesoMap ?? CatalogoLugaresAccesoPrincipal::dropdownOptions();
$catalogoUsosInternetMap = $catalogoUsosInternetMap ?? CatalogoUsosInternet::dropdownOptions();
$usosInternetSeleccionados = $usosInternetSeleccionados ?? [];
$alumOrganizacion = $alumOrganizacion ?? new AlumOrganizacion(['alumnos_id' => $alumno->id ?? null]);
$catalogoOrganizacionesGrouped = $catalogoOrganizacionesGrouped ?? CatalogoOrganizaciones::groupedOptionsByTipo();
$catalogoOrganizacionOtroId = $catalogoOrganizacionOtroId ?? CatalogoOrganizaciones::getOtroId();
$organizacionesSeleccionadas = $organizacionesSeleccionadas ?? [];
$organizacionesOtroMap = $organizacionesOtroMap ?? [];
$deportesSeleccionados = $deportesSeleccionados ?? [];
$ejercicioFisicos = $ejercicioFisicos ?? [];
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

$ejercicioFisicosMap = [];
foreach ($ejercicioFisicos as $ejercicioFisico) {
    $ejercicioFisicosMap[(int)$ejercicioFisico->catalogo_actividad_ejercicio_id] = $ejercicioFisico;
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
    <!-- ?? ACORDEÓN GENERAL -->
    <!-- ===================== -->
    <div class="accordion" id="expedienteAccordion">

        <!-- ===================== -->
        <!-- SECCIÓN 1: DATOS ACADÉMICOS -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDatosAcademicos">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosAcademicos" aria-expanded="true" aria-controls="collapseDatosAcademicos">
                    <i class="fas fa-graduation-cap me-2 text-primary"></i> I. DATOS ACADÉMICOS
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
        <!-- SECCION 2: DATOS PERSONALES -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDatosPersonales">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosPersonales" aria-expanded="false" aria-controls="collapseDatosPersonales">
                    <i class="fas fa-id-card me-2 text-info"></i> II. DATOS PERSONALES
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

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-info-subtle text-info fw-semibold">
                                    <i class="fas fa-user-circle me-2"></i> Perfil institucional
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $perfil, 'nombre', 'fa-user', [
                                                'inputOptions' => [
                                                    'class' => 'form-control bg-light',
                                                    'readonly' => true,
                                                    'value' => Html::encode($perfil->nombre ?? '')
                                                ]
                                            ]) ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $perfil, 'apellido', 'fa-user', [
                                                'inputOptions' => [
                                                    'class' => 'form-control bg-light',
                                                    'readonly' => true,
                                                    'value' => Html::encode($perfil->apellido ?? '')
                                                ]
                                            ]) ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $perfil, 'fecha_nacimiento', 'fa-calendar', [
                                                'inputOptions' => [
                                                    'class' => 'form-control bg-light',
                                                    'readonly' => true,
                                                    'value' => Html::encode($perfil->fecha_nacimiento ?? '')
                                                ]
                                            ]) ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $perfil, 'generoNombre', 'fa-venus-mars', [
                                                'inputOptions' => [
                                                    'class' => 'form-control bg-light',
                                                    'readonly' => true,
                                                    'value' => Html::encode($perfil->generoNombre ?? '')
                                                ]
                                            ]) ?>
                                        </div>
                                        <div class="col-12">
                                            <?= InputHelper::iconTextField($form, $perfil, 'username', 'fa-at', [
                                                'inputOptions' => [
                                                    'class' => 'form-control bg-light',
                                                    'readonly' => true,
                                                    'value' => Html::encode($perfil->username ?? '')
                                                ]
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-warning-subtle text-warning fw-semibold">
                                    <i class="fas fa-id-badge me-2"></i> Identificacion oficial
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <?= InputHelper::iconTextField($form, $datosPersonales, 'curp', 'fa-id-card', [
                                                'inputOptions' => ['placeholder' => 'Ingresa tu CURP...']
                                            ])->label('CURP') ?>
                                            <div class="mt-1">
                                                <small class="text-muted">
                                                    <i class="fas fa-question-circle"></i>
                                                    ¿No sabes tu CURP?
                                                    <a href="https://www.gob.mx/curp/" target="_blank" class="text-primary">
                                                        Consultala aqui
                                                    </a>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <?= InputHelper::iconTextField($form, $datosPersonales, 'nss', 'fa-hospital-user', [
                                                'inputOptions' => ['placeholder' => 'Ingresa tu NSS...']
                                            ])->label('Número de seguro social') ?>
                                            <div class="mt-1">
                                                <small class="text-muted">
                                                    <i class="fas fa-question-circle"></i>
                                                    ¿No sabes tu NSS?
                                                    <a href="https://www.imss.gob.mx/tramites/imss02008" target="_blank" class="text-primary">
                                                        Consultala aqui
                                                    </a>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <?= InputHelper::iconTextField($form, $datosPersonales, 'rfc', 'fa-user-tag', [
                                                'inputOptions' => ['placeholder' => 'Ingresa tu RFC...']
                                            ])->label('RFC') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-lg-12">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-primary-subtle text-primary fw-semibold">
                                    <i class="fas fa-address-card me-2"></i> Contacto y datos generales
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <?= InputHelper::iconTextField($form, $datosGenerales, 'tlf_personal', 'fa-phone', [
                                                'inputOptions' => ['placeholder' => 'Teléfono personal...']
                                            ])->label('Teléfono personal') ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= InputHelper::iconTextField($form, $datosGenerales, 'tlf_emergencia', 'fa-phone-alt', [
                                                'inputOptions' => ['placeholder' => 'Teléfono de emergencia...']
                                            ])->label('Teléfono de emergencia') ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= InputHelper::iconTextField($form, $datosGenerales, 'email_personal', 'fa-envelope', [
                                                'inputOptions' => ['placeholder' => 'Correo electrónico personal...']
                                            ])->label('Correo electrónico personal') ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $datosGenerales,
                                                'estados_civiles_id',
                                                'fa-ring',
                                                EstadosCiviles::getEstadosCivilesMap(),
                                                ['options' => ['placeholder' => 'Estado civil...']]
                                            )->label('Estado civil') ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $datosGenerales,
                                                'nacionalidades_id',
                                                'fa-flag',
                                                Nacionalidades::getNacionalidadesMap(),
                                                ['options' => ['placeholder' => 'Nacionalidad...']]
                                            )->label('Nacionalidad') ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $datosGenerales,
                                                'maya_hablante',
                                                'fa-language',
                                                BooleanHelper::options(),
                                                [
                                                    'placeholder' => 'Habla maya?'
                                                ]
                                            )->label('Habla maya?') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-warning-subtle text-warning fw-semibold">
                                    <i class="fas fa-birthday-cake me-2"></i> Lugar de Nacimiento
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-12">
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
                                            )->label('Entidad federativa') ?>
                                        </div>
                                        <div class="col-md-12">
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
                                            )->label('Municipio') ?>
                                        </div>
                                        <div class="col-md-12">
                                            <?= InputHelper::iconTextField($form, $lugaresNacimiento, 'localidad', 'fa-map-pin', [
                                                'inputOptions' => [
                                                    'placeholder' => 'Localidad...',
                                                    'id' => 'lugaresnacimiento-localidad',
                                                    'disabled' => true
                                                ]
                                            ])->label('Localidad') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-success-subtle text-success fw-semibold">
                                    <i class="fas fa-home me-2"></i> Domicilio actual
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
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
                                            )->label('Entidad federativa') ?>
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
                                            )->label('Municipio') ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'localidad', 'fa-map-pin', [
                                                'inputOptions' => [
                                                    'placeholder' => 'Localidad...',
                                                    'id' => 'domiciliosactuales-localidad',
                                                    'disabled' => true
                                                ]
                                            ])->label('Localidad') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'calle', 'fa-road', [
                                                'inputOptions' => ['placeholder' => 'Calle...']
                                            ])->label('Calle') ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'numero_exterior', 'fa-door-open', [
                                                'inputOptions' => ['placeholder' => 'Número exterior...']
                                            ])->label('Número exterior') ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'numero_interior', 'fa-door-closed', [
                                                'inputOptions' => ['placeholder' => 'Número interior...']
                                            ])->label('Número interior') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'colonia', 'fa-map', [
                                                'inputOptions' => ['placeholder' => 'Colonia...']
                                            ])->label('Colonia') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $domiciliosActuales, 'codigo_postal', 'fa-envelope', [
                                                'inputOptions' => ['placeholder' => 'Código postal...']
                                            ])->label('Código postal') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===================== -->
        <!-- SECCION 3: DATOS FAMILIARES -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDatosFamiliares">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatosFamiliares" aria-expanded="false" aria-controls="collapseDatosFamiliares">
                    <i class="fas fa-people-group me-2 text-success"></i> III. DATOS FAMILIARES
                </button>
            </h2>
            <div id="collapseDatosFamiliares" class="accordion-collapse collapse" aria-labelledby="headingDatosFamiliares" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">

                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 3</span>
                        <div>
                            <div class="fw-semibold">Cuentanos sobre tu familia.</div>
                            <div class="text-muted small">Nombres, apellidos y ocupaciones para padre y madre.</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-success-subtle text-success fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-male me-2"></i> Datos del padre</span>
                                    <span class="badge bg-success text-white">Revisa</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Nombre completo y ocupacion actual de tu padre.</p>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'padre_nombre', 'fa-male', [
                                                'inputOptions' => ['placeholder' => 'Nombre del padre...']
                                            ])->label('Nombre(s) del padre') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'padre_apellido_paterno', 'fa-signature', [
                                                'inputOptions' => ['placeholder' => 'Apellido paterno...']
                                            ])->label('Apellido paterno del padre') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'padre_apellido_materno', 'fa-signature', [
                                                'inputOptions' => ['placeholder' => 'Apellido materno...']
                                            ])->label('Apellido materno del padre') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'padre_ocupacion', 'fa-briefcase', [
                                                'inputOptions' => ['placeholder' => 'Ocupación del padre...']
                                            ])->label('Ocupación del padre') ?>
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
                                            )->label('¿Habla maya? (padre)') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-info-subtle text-info fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-female me-2"></i> Datos de la madre</span>
                                    <span class="badge bg-info text-white">Revisa</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Completa los datos de tu madre con la misma estructura.</p>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'madre_nombre', 'fa-female', [
                                                'inputOptions' => ['placeholder' => 'Nombre de la madre...']
                                            ])->label('Nombre(s) de la madre') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'madre_apellido_paterno', 'fa-signature', [
                                                'inputOptions' => ['placeholder' => 'Apellido paterno...']
                                            ])->label('Apellido paterno de la madre') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'madre_apellido_materno', 'fa-signature', [
                                                'inputOptions' => ['placeholder' => 'Apellido materno...']
                                            ])->label('Apellido materno de la madre') ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconTextField($form, $alumDatosFamiliares, 'madre_ocupacion', 'fa-briefcase', [
                                                'inputOptions' => ['placeholder' => 'Ocupación de la madre...']
                                            ])->label('Ocupación de la madre') ?>
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
                                            )->label('¿Habla maya? (madre)') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-12">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-primary-subtle text-primary fw-semibold">
                                    <i class="fas fa-lightbulb me-2"></i> Guia rapida
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge bg-primary text-white">Tip</span>
                                        <span class="text-muted small">Usa la misma informacion que en documentos oficiales.</span>
                                    </div>
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Manten el orden: nombres y apellidos completos.
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Ocupacion: describe la actividad actual (ej. docente, comerciante).
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Marca si hablan maya para ajustar apoyos culturales.
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                    <i class="fas fa-hand-holding-usd me-2 text-warning"></i> IV. INFORMACIÓN DE BECAS
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

                    <div class="row g-3">
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-warning-subtle text-warning fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-graduation-cap me-2"></i> Estado de tu beca</span>
                                    <span class="badge bg-warning text-dark">Requerido</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Cuentanos si cuentas con beca y que tipo es. Si seleccionas "Otro", especifica.</p>
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-6">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumBecas,
                                                'tiene_beca',
                                                'fa-graduation-cap',
                                                BooleanHelper::options(),
                                                [
                                                    'placeholder' => 'Tienes beca?',
                                                    'options' => [
                                                        'id' => 'alumbecas-tiene_beca'
                                                    ]
                                                ]
                                            )->label('Tienes beca?') ?>
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
                                                        'placeholder' => 'Selecciona el tipo',
                                                        'id' => 'alumbecas-tipos_becas_id'
                                                    ]
                                                ]
                                            )->label('Tipo de beca') ?>
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-1" id="otro-especificar-container" style="display: none;">
                                        <div class="col-md-12">
                                            <?= InputHelper::iconTextField($form, $alumBecas, 'otro_especificar', 'fa-edit', [
                                                'inputOptions' => [
                                                    'placeholder' => 'Describe el tipo de beca...',
                                                    'id' => 'alumbecas-otro_especificar'
                                                ]
                                            ])->label('Especifica si elegiste "Otro"') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-primary-subtle text-primary fw-semibold">
                                    <i class="fas fa-info-circle me-2"></i> Tips rapidos
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Si no tienes beca, solo elige "No" y continua.
                                        </li>
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Al elegir "Otro", describe el nombre completo de la beca.
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Revisa la ortografia: se usa para reportes oficiales.
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                    <i class="fas fa-children me-2 text-info"></i> V. INFORMACIàN DE HIJOS
                </button>
            </h2>

            <div id="collapseHijos" class="accordion-collapse collapse" aria-labelledby="headingHijos" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <?php $tieneHijos = (int)($alumInfoHijos->tiene_hijos ?? 0) === 1; ?>

                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 5</span>
                        <div>
                            <div class="fw-semibold">Declara si tienes hijos.</div>
                            <div class="text-muted small">Si respondes si, captura los datos basicos de cada uno.</div>
                        </div>
                    </div>

                    <div class="row g-3 align-items-stretch">
                        <div class="col-12">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-info-subtle text-info fw-semibold d-flex align-items-center">
                                    <i class="fas fa-baby me-2"></i> Situacion familiar
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-start">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold mb-2" for="aluminfohijos-tiene_hijos">Tiene hijos?</label>
                                            <div class="w-100">
                                                <?= InputHelper::iconSelect2Field(
                                                    $form,
                                                    $alumInfoHijos,
                                                    'tiene_hijos',
                                                    'fa-baby',
                                                    BooleanHelper::options(),
                                                    [
                                                        'placeholder' => 'Selecciona una opcion',
                                                        'options' => ['id' => 'aluminfohijos-tiene_hijos']
                                                    ]
                                                )->label(false) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6 <?= $tieneHijos ? '' : 'd-none' ?>" id="campo-cantidad-hijos">
                                            <label class="form-label fw-semibold mb-2" for="aluminfohijos-cantidad_hijos">Cantidad de hijos</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-secondary" id="btn-restar-hijo"><i class="fas fa-minus"></i></button>
                                                <?= Html::activeInput('number', $alumInfoHijos, 'cantidad_hijos', [
                                                    'class' => 'form-control text-center fw-semibold',
                                                    'placeholder' => '0',
                                                    'min' => 1,
                                                    'max' => 10,
                                                    'id' => 'aluminfohijos-cantidad_hijos',
                                                ]) ?>
                                                <button type="button" class="btn btn-outline-secondary" id="btn-sumar-hijo"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 <?= $tieneHijos ? '' : 'd-none' ?>" id="contenedor-hijos">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                                            <div>
                                                <h6 class="mb-1">Datos de cada hijo</h6>
                                                <p class="text-muted small mb-0">Ingresa nombre completo y fecha de nacimiento.</p>
                                            </div>
                                            <button type="button" class="btn btn-success btn-sm" id="btn-agregar-hijo">
                                                <i class="fas fa-plus me-1"></i> Agregar hijo
                                            </button>
                                        </div>

                                        <div id="lista-hijos" class="row g-3">
                                            <?php foreach ($edadesHijos as $i => $hijo): ?>
                                                <div class="col-12 hijo-item">
                                                    <div class="card border-0 shadow-sm h-100">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                                <span class="badge bg-info-subtle text-info hijo-index">Hijo #<?= $i + 1 ?></span>
                                                                <button type="button" class="btn btn-outline-danger btn-sm btn-eliminar-hijo">
                                                                    <i class="fas fa-trash"></i> Quitar
                                                                </button>
                                                            </div>
                                                            <input type="hidden" class="hijo-id-field" name="EdadesHijos[<?= $i ?>][id]" value="<?= $hijo->id ?>">
                                                            <div class="row g-3">
                                                                <div class="col-md-3">
                                                                    <label class="form-label small text-muted mb-1">Nombre(s)</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                                        <input type="text" class="form-control" name="EdadesHijos[<?= $i ?>][nombre]" value="<?= Html::encode($hijo->nombre) ?>" data-field="nombre" placeholder="Nombre(s)" required pattern=".*\S.*">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label small text-muted mb-1">Apellido paterno</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                                                        <input type="text" class="form-control" name="EdadesHijos[<?= $i ?>][apellido_paterno]" value="<?= Html::encode($hijo->apellido_paterno) ?>" data-field="apellido_paterno" placeholder="Apellido paterno" required pattern=".*\S.*">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label small text-muted mb-1">Apellido materno</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                                                        <input type="text" class="form-control" name="EdadesHijos[<?= $i ?>][apellido_materno]" value="<?= Html::encode($hijo->apellido_materno) ?>" data-field="apellido_materno" placeholder="Apellido materno" required pattern=".*\S.*">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label small text-muted mb-1">Fecha de nacimiento</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                                        <input type="date" class="form-control" name="EdadesHijos[<?= $i ?>][fecha_nacimiento]" value="<?= Html::encode($hijo->fecha_nacimiento) ?>" data-field="fecha_nacimiento" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 <?= $tieneHijos ? '' : 'd-none' ?>" id="tip-cantidad-hijos">
                                            <div class="form-text text-muted small">Usa los botones para ajustar; se crean las tarjetas automaticamente.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-12">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-primary-subtle text-primary fw-semibold">
                                    <i class="fas fa-lightbulb me-2"></i> Consejos rapidos
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Si no tienes hijos, elige "No" y continua.
                                        </li>
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Usa + y - para ajustar la cantidad; puedes agregar o quitar tarjetas.
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Verifica nombres y fechas, se usan para reportes oficiales.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    $this->registerJsFile(
                        '@web/js/expediente/expediente-hijos.js',
                        ['depends' => [\yii\web\JqueryAsset::class]]
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
                    <i class="fas fa-piggy-bank me-2 text-primary"></i> VI. SITUACIÓN SOCIOECONÓMICA
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

                    <?php
                    $mostrarDependientes = (int)($alumDependenEconomica->tiene_dependientes ?? 0) === 1;
                    $mostrarTrabajo = (int)($alumTrabajo->tiene_trabajo ?? 0) === 1;
                    $esOtroDep = ($alumDependeEconomicamente->catalogo_dependencias_economicas_id ?? null) === $otroCatalogoDependenciaId;

                    $mostrarOtroDependiente = ($otroCatalogoDependenciaId !== null && in_array((int)$otroCatalogoDependenciaId, $dependientesSeleccionados, true));
                    ?>

                    <!-- Fila 1: Dependencia + Tips -->
                    <div class="row g-3 align-items-stretch">
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-primary-subtle text-primary fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-hand-holding-usd me-2"></i> Dependencia económica</span>
                                    <span class="badge bg-primary text-white">Requerido</span>
                                </div>

                                <div class="card-body">
                                    <p class="text-muted small mb-3">Selecciona de quién depende tu economía. Si eliges “Otro”, especifica.</p>

                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-6">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumDependeEconomicamente,
                                                'catalogo_dependencias_economicas_id',
                                                'fa-hand-holding-usd',
                                                CatalogoDependenciasEconomicas::dropdownOptions(),
                                                [
                                                    'placeholder' => 'Selecciona de quién dependes...',
                                                    'id' => 'alumdependeeconomicamente-catalogo_dependencias_economicas_id',

                                                ],
                                                ['allowClear' => true]
                                            )->label('¿De quién dependes económicamente?', ['class' => 'form-label fw-semibold']) ?>
                                        </div>

                                        <div class="col-md-6 <?= $esOtroDep ? '' : 'd-none' ?>" id="otro-dependencia-container">
                                            <?= InputHelper::iconTextField(
                                                $form,
                                                $alumDependeEconomicamente,
                                                'otro_especificar',
                                                'fa-pen',
                                                [
                                                    'inputOptions' => [
                                                        'placeholder' => 'Especifica “Otro”...',
                                                        'id' => 'alumdependeeconomicamente-otro_especificar',
                                                    ],
                                                ]
                                            )->label('Especifica', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-shield-alt me-1"></i>
                                            Esta información se usa para apoyos y seguimiento tutorial.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-info-subtle text-info fw-semibold">
                                    <i class="fas fa-info-circle me-2"></i> Tips rápidos
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Si no aplica “Otro”, no lo llenes.
                                        </li>
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Selecciona con sinceridad: ayuda a detectar necesidades.
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Revisa ortografía: se usa en reportes.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 2: Dependientes + Trabajo -->
                    <div class="row g-3 mt-1 align-items-stretch">

                        <!-- Dependientes -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-success-subtle text-success fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-users me-2"></i> Dependientes económicos</span>
                                    <span class="badge bg-success text-white">Opcional</span>
                                </div>

                                <div class="card-body">
                                    <p class="text-muted small mb-3">Indica si tú mantienes económicamente a alguien y selecciona quiénes.</p>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumDependenEconomica,
                                                'tiene_dependientes',
                                                'fa-user-friends',
                                                BooleanHelper::options(),
                                                [
                                                    'options' => [
                                                        'placeholder' => '¿Tienes dependientes?',
                                                        'id' => 'alumdependeneconomica-tiene_dependientes',
                                                    ],
                                                ],
                                                ['allowClear' => true]
                                            )->label('¿Tienes dependientes?', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                    </div>

                                    <div class="mt-3 <?= $mostrarDependientes ? '' : 'd-none' ?> card shadow-sm bg-light-subtle p-3" id="dependientes-section">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                                            <div>
                                                <h6 class="mb-0">Selecciona dependientes</h6>
                                                <div class="text-muted small">Marca todas las opciones que apliquen.</div>
                                            </div>
                                            <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">Checklist</span>
                                        </div>

                                        <div class="dependientes-error-msg alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <div class="fw-semibold small mb-0">Selecciona al menos una opción.</div>
                                        </div>

                                        <div class="row g-3">
                                            <?php foreach ($catalogoDependenciasOptions as $id => $nombre): ?>
                                                <?php $checked = in_array((int)$id, $dependientesSeleccionados, true); ?>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="border rounded p-3 h-100">
                                                        <div class="form-check mb-0">
                                                            <input
                                                                type="checkbox"
                                                                class="form-check-input dependiente-checkbox"
                                                                name="Dependientes[ids][]"
                                                                value="<?= (int)$id ?>"
                                                                id="dependiente-<?= (int)$id ?>"
                                                                data-otro-id="<?= (int)$otroCatalogoDependenciaId ?>"
                                                                <?= $checked ? 'checked' : '' ?>>
                                                            <label class="form-check-label fw-semibold" for="dependiente-<?= (int)$id ?>">
                                                                <?= Html::encode($nombre) ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <div class="mt-3 <?= $mostrarOtroDependiente ? '' : 'd-none' ?>" id="otro-dependiente-container">
                                            <label class="form-label fw-semibold" for="dependientes-otro">Especifica “Otro”</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                                <input
                                                    type="text"
                                                    name="Dependientes[otro_especificar]"
                                                    id="dependientes-otro"
                                                    class="form-control"
                                                    placeholder="Especificar otro..."
                                                    value="<?= Html::encode($dependientesOtro ?? '') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trabajo -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-warning-subtle text-warning fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-briefcase me-2"></i> Trabajo</span>
                                    <span class="badge bg-warning text-dark">Opcional</span>
                                </div>

                                <div class="card-body">
                                    <p class="text-muted small mb-3">Indica si trabajas actualmente. Si respondes “Sí”, completa los datos.</p>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumTrabajo,
                                                'tiene_trabajo',
                                                'fa-briefcase',
                                                BooleanHelper::options(),
                                                [
                                                    'options' => [
                                                        'placeholder' => '¿Tienes trabajo?',
                                                        'id' => 'alumtrabajo-tiene_trabajo',
                                                    ],
                                                ],
                                                ['allowClear' => true]
                                            )->label('¿Tienes trabajo?', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-1 <?= $mostrarTrabajo ? '' : 'd-none' ?>" id="trabajo-section">
                                        <div class="col-md-12">
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
                                            )->label('Empresa', ['class' => 'form-label fw-semibold']) ?>
                                        </div>

                                        <div class="col-md-12">
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
                                            )->label('Puesto / Ocupación', ['class' => 'form-label fw-semibold']) ?>
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
                                            )->label('Hora de entrada', ['class' => 'form-label fw-semibold']) ?>
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
                                            )->label('Hora de salida', ['class' => 'form-label fw-semibold']) ?>
                                        </div>

                                        <div class="col-12">
                                            <small class="text-muted">
                                                <i class="fas fa-lightbulb me-1"></i>
                                                Si tu horario es variable, coloca un aproximado.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /row -->

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
                    <div class="row g-3">
                        <div class="col-lg-7">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-success-subtle text-success fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-house-user me-2"></i> Vivienda</span>
                                    <span class="badge bg-success text-white">Requerido</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Indica con quién vives y el tipo de vivienda. Si seleccionas “Otro”, especifica.</p>
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
                                                        'placeholder' => '¿Vives con tus padres?',
                                                        'id' => 'alumvivienda-vives_casa_padres',
                                                    ],
                                                ]
                                            )->label('¿Vives con tus padres?', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                        <div class="col-md-6 <?= ((int)($alumVivienda->vives_casa_padres ?? 1) === 0) ? '' : 'd-none' ?>" id="vivienda-otro-vives-container">
                                            <?= InputHelper::iconTextField(
                                                $form,
                                                $alumVivienda,
                                                'otro_especificar',
                                                'fa-user-friends',
                                                [
                                                    'inputOptions' => [
                                                        'placeholder' => 'Especifica con quién vives...',
                                                        'id' => 'alumvivienda-otro_especificar',
                                                    ],
                                                ]
                                            )->label('Especifica', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumVivienda,
                                                'tipos_viviendas_id',
                                                'fa-building',
                                                $tiposViviendasMap,
                                                [
                                                    'options' => [
                                                        'placeholder' => 'Tipo de vivienda...',
                                                        'id' => 'alumvivienda-tipos_viviendas_id',
                                                    ],
                                                ]
                                            )->label('Tipo de vivienda', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                        <div class="col-md-6 <?= ($tipoViviendaOtroId !== null && (int)($alumVivienda->tipos_viviendas_id ?? 0) === $tipoViviendaOtroId) ? '' : 'd-none' ?>" id="vivienda-otro-tipo-container">
                                            <?= InputHelper::iconTextField(
                                                $form,
                                                $alumVivienda,
                                                'otro_tipo_especificar',
                                                'fa-edit',
                                                [
                                                    'inputOptions' => [
                                                        'placeholder' => 'Especifica otro tipo...',
                                                        'id' => 'alumvivienda-otro_tipo_especificar',
                                                    ],
                                                ]
                                            )->label('Especifica “Otro”', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-info-subtle text-info fw-semibold">
                                    <i class="fas fa-info-circle me-2"></i> Tips rápidos
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Usa “Otro” solo si no encuentras la opción en la lista.
                                        </li>
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Verifica ortografía: se usa en reportes y seguimientos.
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                            Puedes actualizar esta información cuando cambie tu situación.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $mostrarOtroBien = $catalogoBienOtroId !== null && in_array((int)$catalogoBienOtroId, $bienesSeleccionados, true);
                    $mostrarOtroServicio = $catalogoServicioOtroId !== null && in_array((int)$catalogoServicioOtroId, $serviciosSeleccionados, true);
                    ?>
                    <div class="row g-3 mt-3">
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-primary-subtle text-primary fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-couch me-2"></i> Bienes de la vivienda</span>
                                    <span class="badge bg-primary text-white">Opcional</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Selecciona los bienes con los que cuentas. Marca “Otro” si necesitas especificar.</p>
                                    <?php
                                    $bienesOptionsOrdered = $catalogoBienesOptions;
                                    if ($catalogoBienOtroId !== null && isset($bienesOptionsOrdered[$catalogoBienOtroId])) {
                                        $otroNombre = $bienesOptionsOrdered[$catalogoBienOtroId];
                                        unset($bienesOptionsOrdered[$catalogoBienOtroId]);
                                        $bienesOptionsOrdered[$catalogoBienOtroId] = $otroNombre;
                                    }
                                    ?>
                                    <div class="row g-2">
                                        <?php foreach ($bienesOptionsOrdered as $id => $nombre): ?>
                                            <?php $checked = in_array((int)$id, $bienesSeleccionados, true); ?>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-check">
                                                    <input
                                                        type="checkbox"
                                                        class="form-check-input vivienda-bien-checkbox"
                                                        name="ViviendaBienes[ids][]"
                                                        value="<?= (int)$id ?>"
                                                        id="vivienda-bien-<?= (int)$id ?>"
                                                        data-otro-id="<?= (int)$catalogoBienOtroId ?>"
                                                        <?= $checked ? 'checked' : '' ?>>
                                                    <label class="form-check-label fw-semibold" for="vivienda-bien-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="mt-3 <?= $mostrarOtroBien ? '' : 'd-none' ?>" id="vivienda-bienes-otro-container">
                                        <label class="form-label fw-semibold" for="vivienda-bienes-otro">Especifica “Otro”</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                            <input type="text" name="ViviendaBienes[otro_especificar]" id="vivienda-bienes-otro" class="form-control" placeholder="Especifica otro bien..." value="<?= Html::encode($bienesOtro ?? '') ?>">
                                            <div class="invalid-feedback">Especifica el bien.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-warning-subtle text-warning fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-plug me-2"></i> Servicios de la vivienda</span>
                                    <span class="badge bg-warning text-dark">Opcional</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Marca los servicios disponibles. Si eliges “Otro”, escribe cuál.</p>
                                    <div class="row g-2">
                                        <?php foreach ($catalogoServiciosViviendaOptions as $id => $nombre): ?>
                                            <?php $checked = in_array((int)$id, $serviciosSeleccionados, true); ?>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-check">
                                                    <input
                                                        type="checkbox"
                                                        class="form-check-input vivienda-servicio-checkbox"
                                                        name="ViviendaServicios[ids][]"
                                                        value="<?= (int)$id ?>"
                                                        id="vivienda-servicio-<?= (int)$id ?>"
                                                        data-otro-id="<?= (int)$catalogoServicioOtroId ?>"
                                                        <?= $checked ? 'checked' : '' ?>>
                                                    <label class="form-check-label fw-semibold" for="vivienda-servicio-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="mt-3 <?= $mostrarOtroServicio ? '' : 'd-none' ?>" id="vivienda-servicios-otro-container">
                                        <label class="form-label fw-semibold" for="vivienda-servicios-otro">Especifica “Otro”</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                            <input
                                                type="text"
                                                name="ViviendaServicios[otro_especificar]"
                                                id="vivienda-servicios-otro"
                                                class="form-control"
                                                placeholder="Especifica otro servicio..."
                                                value="<?= Html::encode($serviciosOtro ?? '') ?>">
                                            <div class="invalid-feedback">Especifica el servicio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary-subtle text-primary fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-user-check me-2"></i> Bienes personales</span>
                            <span class="badge bg-primary text-white">Opcional</span>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">Marca los bienes personales con los que cuentas. Puedes seleccionar varias opciones.</p>
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
                                            <label class="form-check-label fw-semibold" for="bien-personal-<?= (int)$id ?>"><?= Html::encode($nombre) ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
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
                    <i class="fas fa-bus me-2 text-warning"></i> IX. TRANSPORTE Y ACCESO
                </button>
            </h2>
            <div id="collapseTransporteAcceso" class="accordion-collapse collapse" aria-labelledby="headingTransporteAcceso" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 9</span>
                        <div>
                            <div class="fw-semibold">Transporte y tiempos.</div>
                            <div class="text-muted small">C¢mo llegas a la escuela y cu nto tardas.</div>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-warning-subtle text-warning fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-bus me-2"></i> Transporte y acceso</span>
                            <span class="badge bg-warning text-dark">Opcional</span>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">Selecciona el medio de transporte principal y el tiempo aproximado de recorrido.</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <?= InputHelper::iconSelect2Field(
                                        $form,
                                        $alumTransportes,
                                        'catalogo_transportes_id',
                                        'fa-bus',
                                        $catalogoTransportesMap,
                                        ['placeholder' => 'Medio de transporte...']
                                    )->label('Medio de transporte', ['class' => 'form-label fw-semibold']) ?>
                                    <small class="text-muted">Selecciona c¢mo llegas a la escuela.</small>
                                </div>
                                <div class="col-md-6">
                                    <?= InputHelper::iconSelect2Field(
                                        $form,
                                        $alumTransportes,
                                        'tiempo_recorrido_transporte_id',
                                        'fa-stopwatch',
                                        $tiemposRecorridoMap,
                                        ['placeholder' => 'Tiempo de recorrido...']
                                    )->label('Tiempo de recorrido', ['class' => 'form-label fw-semibold']) ?>
                                    <small class="text-muted">Indica el tiempo promedio en llegar.</small>
                                </div>
                            </div>
                        </div>
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
                    <i class="fas fa-heartbeat me-2 text-danger"></i> X. SALUD
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

                    <div class="row g-3 mb-3">
                        <div class="col-lg-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-light fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-heart text-danger me-2"></i> Resumen y tips</span>
                                    <span class="badge bg-danger-subtle text-danger">Salud</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Activa solo lo que aplique; veras los campos debajo de cada opcion.</p>
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-toggle-on text-success me-2 mt-1"></i>
                                            Los bloques se muestran debajo de cada pregunta al elegir "Si".
                                        </li>
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-clipboard-check text-primary me-2 mt-1"></i>
                                            Usa gravedad y fechas para priorizar seguimiento.
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-comment-dots text-warning me-2 mt-1"></i>
                                            Si eliges "Otro", describe brevemente para dejar contexto.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-danger-subtle text-danger fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-heartbeat me-2"></i> Chequeos basicos</span>
                                    <span class="badge bg-danger text-white">Requerido</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Completa estas preguntas base; sus detalles apareceran debajo.</p>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumAsisteMedico,
                                                'frecuencia_tiempo_id',
                                                'fa-stethoscope',
                                                $frecuenciasTiempoMap,
                                                [
                                                    'placeholder' => 'Periodicidad de consultas medicas',
                                                    'id' => 'alumasistemedico-frecuencia_tiempo_id',
                                                ]
                                            )->label('Con que frecuencia acudes al medico?', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumAsisteDentista,
                                                'frecuencia_tiempo_id',
                                                'fa-tooth',
                                                $frecuenciasTiempoMap,
                                                [
                                                    'placeholder' => 'Periodicidad de consultas dentales',
                                                    'id' => 'alumasistedentista-frecuencia_tiempo_id',
                                                ]
                                            )->label('Con que frecuencia acudes al dentista?', ['class' => 'form-label fw-semibold']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $problemasSaludSeleccionados = [];
                    foreach ($problemasSalud as $ps) {
                        $problemasSaludSeleccionados[(int)$ps->catalogo_problemas_salud_id] = $ps;
                    }
                    ?>
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-secondary-subtle text-secondary fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-notes-medical me-2"></i> Problemas de salud</span>
                            <span class="badge bg-secondary text-dark">Detalle</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <?= InputHelper::iconSelect2Field(
                                        $form,
                                        $alumEstadoSalud,
                                        'tuvo_problema_salud',
                                        'fa-heartbeat',
                                        BooleanHelper::options(),
                                        [
                                            'placeholder' => 'Antecedentes de problemas de salud',
                                            'id' => 'alumestadosalud-tuvo_problema_salud',
                                        ]
                                    )->label('Has tenido problemas de salud importantes?', ['class' => 'form-label fw-semibold']) ?>
                                </div>
                            </div>
                            <div id="salud-problemas-container" class="mt-3 card shadow-sm bg-light-subtle p-3 <?= ((int)($alumEstadoSalud->tuvo_problema_salud ?? 0) === 1) ? '' : 'd-none' ?>">
                                <p class="text-muted small mb-3">Selecciona los problemas de salud que has tenido y su gravedad.</p>
                                <div class="problemas-error-msg alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="fw-semibold small mb-0">Selecciona al menos una opcion.</div>
                                </div>
                                <?php
                                $problemasOrdenados = $catalogoProblemasSaludMap;
                                if ($otroCatalogoProblemaId !== null) {
                                    $otroKey = (int)$otroCatalogoProblemaId;
                                    if (array_key_exists($otroKey, $problemasOrdenados)) {
                                        $valorOtro = $problemasOrdenados[$otroKey];
                                        unset($problemasOrdenados[$otroKey]);
                                        $problemasOrdenados[$otroKey] = $valorOtro;
                                    }
                                }
                                ?>
                                <div id="lista-problemas" class="row g-3">
                                    <?php foreach ($problemasOrdenados as $id => $nombre): ?>
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
                        </div>
                    </div>
                    <?php
                    $enfermedadesCronicasSeleccionadas = $enfermedadesCronicasSeleccionadas ?? [];
                    ?>
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-danger-subtle text-danger fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-notes-medical me-2"></i> Enfermedades crónicas</span>
                            <span class="badge bg-danger text-white">Detalle</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <?= InputHelper::iconSelect2Field(
                                        $form,
                                        $alumEnfermedadesCronicas,
                                        'padece_enfermedades_cronicas',
                                        'fa-notes-medical',
                                        BooleanHelper::options(),
                                        [
                                            'placeholder' => 'Diagnosticos vigentes de enfermedades cronicas',
                                            'id' => 'alumenfermedadescronicas-padece_enfermedades_cronicas',
                                        ]
                                    )->label('Tienes alguna enfermedad cronica diagnosticada actualmente?', ['class' => 'form-label fw-semibold']) ?>
                                </div>
                            </div>
                            <div id="salud-enfermedades-cronicas-container" class="mt-3 card shadow-sm bg-light-subtle p-3 <?= ((int)($alumEnfermedadesCronicas->padece_enfermedades_cronicas ?? 0) === 1) ? '' : 'd-none' ?>">
                                <p class="text-muted small mb-3">Activa las enfermedades cronicas que padeces y detalla si aplica.</p>
                                <div class="enfermedades-error-msg alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="fw-semibold small mb-0">Selecciona al menos una opcion.</div>
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
                        </div>
                    </div>

                    <?php
                    $alergiasSeleccionadas = [];
                    foreach ($alergias as $alergia) {
                        $alergiasSeleccionadas[(int)$alergia->catalogo_alergias_id] = $alergia;
                    }
                    ?>
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-warning-subtle text-warning fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-allergies me-2"></i> Alergias</span>
                            <span class="badge bg-warning text-dark">Detalle</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <?= InputHelper::iconSelect2Field(
                                        $form,
                                        $alumAlergia,
                                        'padeces_alergias',
                                        'fa-allergies',
                                        BooleanHelper::options(),
                                        [
                                            'placeholder' => 'Diagnosticos de alergias',
                                            'id' => 'alumalergia-padeces_alergias',
                                        ]
                                    )->label('Te han diagnosticado alergias?', ['class' => 'form-label fw-semibold']) ?>
                                </div>
                            </div>
                            <div id="salud-alergias-container" class="mt-3 card shadow-sm bg-light-subtle p-3 <?= ((int)($alumAlergia->padeces_alergias ?? 0) === 1) ? '' : 'd-none' ?>">
                                <p class="text-muted small mb-3">Activa las alergias que padeces y registra su gravedad y reacciones.</p>
                                <div class="alergias-error-msg alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="fw-semibold small mb-0">Selecciona al menos una opcion.</div>
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
                        </div>
                    </div>
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-info-subtle text-info fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-pills me-2"></i> Tratamientos</span>
                            <span class="badge bg-info text-dark">Detalle</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <?= InputHelper::iconSelect2Field(
                                        $form,
                                        $alumTratamientos,
                                        'esta_en_tratamiento',
                                        'fa-pills',
                                        BooleanHelper::options(),
                                        [
                                            'placeholder' => 'Tratamientos o terapias activos',
                                            'id' => 'alumtratamientos-esta_en_tratamiento',
                                        ]
                                    )->label('Estas en algun tratamiento o terapia actualmente?', ['class' => 'form-label fw-semibold']) ?>
                                </div>
                            </div>
                            <div id="salud-tratamientos-container" class="mt-3 card shadow-sm bg-light-subtle p-3 <?= ((int)($alumTratamientos->esta_en_tratamiento ?? 0) === 1) ? '' : 'd-none' ?>">
                                <p class="text-muted small mb-3">Selecciona los tratamientos que sigues y especifica frecuencia y fechas.</p>
                                <div class="tratamientos-error-msg alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="fw-semibold small mb-0">Selecciona al menos un tratamiento.</div>
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
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-success-subtle text-success fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-briefcase-medical me-2"></i> Servicios de salud</span>
                            <span class="badge bg-success text-dark">Selecciona</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <?= InputHelper::iconSelect2Field(
                                        $form,
                                        $alumServiciosSalud,
                                        'tiene_servicios_salud',
                                        'fa-briefcase-medical',
                                        BooleanHelper::options(),
                                        [
                                            'placeholder' => 'Cobertura o afiliacion a servicios de salud',
                                            'id' => 'alumserviciossalud-tiene_servicios_salud',
                                        ]
                                    )->label('Cuentas con algun servicio o cobertura de salud?', ['class' => 'form-label fw-semibold']) ?>
                                </div>
                            </div>
                            <div id="salud-servicios-container" class="mt-3 card shadow-sm bg-light-subtle p-3 <?= ((int)($alumServiciosSalud->tiene_servicios_salud ?? 0) === 1) ? '' : 'd-none' ?>">
                                <p class="text-muted small mb-3">Marca los servicios de salud con los que cuentas.</p>
                                <div class="servicios-error-msg alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="fw-semibold small mb-0">Selecciona al menos una opcion.</div>
                                </div>
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

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-primary-subtle text-primary fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-glasses me-2"></i> Uso de anteojos</span>
                            <span class="badge bg-primary text-white">Detalle</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <?= InputHelper::iconSelect2Field(
                                        $form,
                                        $alumUsoAnteojos,
                                        'utilizas_anteojos',
                                        'fa-glasses',
                                        BooleanHelper::options(),
                                        [
                                            'placeholder' => 'Uso de lentes o anteojos',
                                            'id' => 'alumusoanteojos-utilizas_anteojos',
                                        ]
                                    )->label('Utilizas anteojos o lentes de contacto?', ['class' => 'form-label fw-semibold']) ?>
                                </div>
                            </div>
                            <div id="salud-anteojos-container" class="mt-3 card shadow-sm bg-light-subtle p-3 <?= ((int)($alumUsoAnteojos->utilizas_anteojos ?? 0) === 1) ? '' : 'd-none' ?>">
                                <p class="text-muted small mb-3">Selecciona el tipo de uso de anteojos.</p>
                                <div class="anteojos-error-msg alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="fw-semibold small mb-0">Selecciona al menos una opcion.</div>
                                </div>
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
                    <i class="fas fa-utensils me-2 text-success"></i> XI. ALIMENTACION
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

                    <div class="row g-3 mb-4">
                        <div class="col-lg-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-light fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-seedling me-2 text-success"></i> Tips rapidos</span>
                                    <span class="badge bg-success-subtle text-success">Alimentacion</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Manten consistencia con tus respuestas previas y activa solo lo que aplique.</p>
                                    <ul class="list-unstyled small text-muted mb-0">
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-toggle-on text-success me-2 mt-1"></i>
                                            Marca los lugares donde realmente comes; puedes elegir varios.
                                        </li>
                                        <li class="d-flex align-items-start mb-2">
                                            <i class="fas fa-info-circle text-primary me-2 mt-1"></i>
                                            Si seleccionas "Otro", describe el lugar para mantener claridad.
                                        </li>
                                        <li class="d-flex align-items-start">
                                            <i class="fas fa-clock text-warning me-2 mt-1"></i>
                                            Ajusta las frecuencias pensando en tu semana habitual.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-success-subtle text-success fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-map-marker-alt me-2"></i> Lugares donde sueles comer</span>
                                    <span class="badge bg-success text-white">Selecciona</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-3">Selecciona todos los lugares aplicables; los detalles de "Otro" se habilitan al marcarlo.</p>
                                    <div class="alert alert-danger py-2 px-3 small d-none" id="lugar-comer-error">
                                        Selecciona al menos un lugar donde sueles comer.
                                    </div>
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
                                    <div class="row g-3">
                                        <?php foreach ($catalogoLugaresComerOrdenados as $id => $nombreLimpio): ?>
                                            <?php
                                            $id = (int)$id;
                                            $checked = in_array($id, $lugaresComerSeleccionados, true);
                                            $esNombreOtro = mb_strtolower($nombreLimpio, 'UTF-8') === 'otro';
                                            $esOtro = ($catalogoLugarComerOtroId !== null && $id === (int)$catalogoLugarComerOtroId) || $esNombreOtro;
                                            ?>
                                            <div class="col-sm-6">
                                                <div class="form-check lugar-comer-item mb-2">
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
                                                    <div class="mt-1 lugar-comer-otro-container <?= $checked ? '' : 'd-none' ?>">
                                                        <label class="form-label small text-muted" for="lugar-comer-otro-<?= $id ?>">Especifica el lugar</label>
                                                        <input
                                                            type="text"
                                                            class="form-control lugar-comer-otro-input"
                                                            name="AlumLugaresComer[<?= $id ?>][lugar_otro]"
                                                            id="lugar-comer-otro-<?= $id ?>"
                                                            value="<?= Html::encode($lugaresComerOtroMap[$id] ?? $lugarComerOtro) ?>"
                                                            <?= $checked ? '' : 'disabled' ?>>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $consumoMap = [];
                    foreach ($consumoAlimentos as $cons) {
                        $consumoMap[(int)$cons->catalogo_alimentos_id] = $cons;
                    }
                    ?>
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light fw-semibold d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-apple-alt me-2 text-danger"></i> Frecuencia de consumo de alimentos</span>
                            <span class="badge bg-danger text-white">Frecuencia</span>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">Indica cuantas veces por semana consumes cada grupo de alimentos.</p>
                            <div class="row g-3">
                                <?php foreach ($catalogoAlimentosMap as $id => $nombreAlimento): ?>
                                    <?php
                                    $id = (int)$id;
                                    $consumo = $consumoMap[$id] ?? new AlumConsumoAlimentos([
                                        'catalogo_alimentos_id' => $id,
                                        'alumnos_id' => $alumnoId,
                                    ]);
                                    $frecuenciaSeleccionada = $consumo->frecuencia_veces_id ?? null;
                                    ?>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="consumo-tile h-100">
                                            <div class="d-flex align-items-center justify-content-between consumo-tile-header">
                                                <div class="d-flex align-items-center gap-2 consumo-tile-title">
                                                    <span class="consumo-marker"></span>
                                                    <strong><?= Html::encode($nombreAlimento) ?></strong>
                                                </div>
                                                <?php if ($frecuenciaSeleccionada): ?>
                                                    <span class="consumo-chip">Seleccionado</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="mt-3 consumo-tile-select">
                                                <?= InputHelper::iconSelect2Field(
                                                    $form,
                                                    $consumo,
                                                    "[{$id}]frecuencia_veces_id",
                                                    "fa-calendar-week",
                                                    $frecuenciasVecesMap,
                                                    [
                                                        "placeholder" => "Frecuencia semanal (veces)",
                                                        "id" => "consumo-frecuencia-{$id}",
                                                    ],
                                                    ["allowClear" => true]
                                                )->label('Frecuencia semanal (veces)', ['class' => 'form-label fw-semibold small mb-1']) ?>
                                                <input type="hidden" name="AlumConsumoAlimentos[<?= $id ?>][catalogo_alimentos_id]" value="<?= $id ?>">
                                                <input type="hidden" name="AlumConsumoAlimentos[<?= $id ?>][alumnos_id]" value="<?= $alumnoId ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 12: ACTIVIDAD FISICA Y DEPORTE -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingActividadFisica">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseActividadFisica" aria-expanded="false" aria-controls="collapseActividadFisica">
                    <i class="fas fa-dumbbell me-2 text-primary"></i> XII. ACTIVIDAD FISICA Y DEPORTE
                </button>
            </h2>
            <div id="collapseActividadFisica" class="accordion-collapse collapse" aria-labelledby="headingActividadFisica" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 12</span>
                        <div>
                            <div class="fw-semibold">Actividad fisica y deporte.</div>
                            <div class="text-muted small">Responde cada pregunta y, si aplican, selecciona tus opciones.</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div id="actividad-deportes-container" class="card shadow-sm border-0 actividad-card h-100">
                                <div class="card-header bg-success-subtle text-success fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-running me-2"></i> Deportes que practicas</span>
                                    <span class="badge bg-success text-white">Selecciona</span>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 mb-2">
                                        <div class="col-md-12">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumDeportes,
                                                "practicas_algun_deporte",
                                                "fa-basketball-ball",
                                                BooleanHelper::options(),
                                                [
                                                    "placeholder" => "Practicas algun deporte?",
                                                    "id" => "alumdeportes-practicas_algun_deporte",
                                                ]
                                            ) ?>
                                        </div>
                                    </div>
                                    <div id="actividad-deportes-opciones" class="<?= ((int)($alumDeportes->practicas_algun_deporte ?? 0) === 1) ? '' : 'd-none' ?>">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                                            <div>
                                                <h5 class="mb-1">Activa los deportes que realizas</h5>
                                                <p class="text-muted small mb-0">Selecciona todos los deportes aplicables; los detalles de "Otro" se habilitan al marcarlo.</p>
                                            </div>
                                            <span class="badge bg-info-subtle text-info fw-semibold px-3 py-2">Al menos uno</span>
                                        </div>
                                        <div class="alert alert-danger py-2 px-3 small d-none" id="deporte-error">
                                            Selecciona al menos un deporte que practiques.
                                        </div>
                                        <div class="row g-2 mt-2">
                                            <?php foreach ($catalogoDeportesMap as $id => $nombre): ?>
                                                <?php
                                                $id = (int)$id;
                                                $checked = in_array($id, $deportesSeleccionados, true);
                                                ?>
                                                <div class="col-sm-6 col-md-6 col-12">
                                                    <div class="form-check deporte-check">
                                                        <input
                                                            class="form-check-input deporte-checkbox"
                                                            type="checkbox"
                                                            id="deporte-<?= $id ?>"
                                                            name="Deportes[<?= $id ?>][selected]"
                                                            value="1"
                                                            <?= $checked ? "checked" : "" ?>>
                                                        <label class="form-check-label fw-semibold" for="deporte-<?= $id ?>">
                                                            <?= Html::encode($nombre) ?>
                                                        </label>
                                                        <input type="hidden" name="Deportes[<?= $id ?>][catalogo_deportes_id]" value="<?= $id ?>">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div id="actividad-ejercicio-container" class="card shadow-sm border-0 actividad-card h-100">
                                <div class="card-header bg-info-subtle text-info fw-semibold d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-dumbbell me-2"></i> Ejercicio fisico</span>
                                    <span class="badge bg-info text-white">Rutina</span>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 mb-2">
                                        <div class="col-md-12">
                                            <?= InputHelper::iconSelect2Field(
                                                $form,
                                                $alumEjercicio,
                                                "haces_ejercicio_fisico",
                                                "fa-dumbbell",
                                                BooleanHelper::options(),
                                                [
                                                    "placeholder" => "Realizas ejercicio fisico?",
                                                    "id" => "alumejercicio-haces_ejercicio_fisico",
                                                ]
                                            ) ?>
                                        </div>
                                    </div>
                                    <div id="actividad-ejercicio-opciones" class="<?= ((int)($alumEjercicio->haces_ejercicio_fisico ?? 0) === 1) ? '' : 'd-none' ?>">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                                            <div>
                                                <h5 class="mb-1">Selecciona tus actividades y frecuencia</h5>
                                                <p class="text-muted small mb-0">Marca tus actividades actuales e indica cuantas veces por semana.</p>
                                            </div>
                                            <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Frecuencia requerida</span>
                                        </div>
                                        <div class="alert alert-danger py-2 px-3 small d-none" id="ejercicio-error">
                                            Selecciona al menos una actividad física y su frecuencia semanal.
                                        </div>

                                        <div id="lista-ejercicio-fisico" class="row g-3">
                                            <?php foreach ($catalogoActividadesEjercicioMap as $id => $nombre): ?>
                                                <?php
                                                $id = (int)$id;
                                                $ejercicio = $ejercicioFisicosMap[$id] ?? new EjercicioFisico([
                                                    "catalogo_actividad_ejercicio_id" => $id,
                                                    "alum_ejercicio_id" => $alumEjercicio->id ?? null,
                                                ]);
                                                $seleccionado = isset($ejercicioFisicosMap[$id]);
                                                ?>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="actividad-tile h-100 ejercicio-item" data-ejercicio-id="<?= $id ?>">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="form-check form-switch">
                                                                <input
                                                                    class="form-check-input ejercicio-checkbox"
                                                                    type="checkbox"
                                                                    id="ejercicio-<?= $id ?>"
                                                                    name="EjercicioFisico[<?= $id ?>][selected]"
                                                                    value="1"
                                                                    <?= $seleccionado ? "checked" : "" ?>>
                                                                <label class="form-check-label fw-semibold" for="ejercicio-<?= $id ?>">
                                                                    <?= Html::encode($nombre) ?>
                                                                </label>
                                                                <input type="hidden" name="EjercicioFisico[<?= $id ?>][catalogo_actividad_ejercicio_id]" value="<?= $id ?>">
                                                            </div>
                                                        </div>

                                                        <div class="ejercicio-detalle mt-3 <?= $seleccionado ? "" : "d-none" ?>">
                                                            <?= InputHelper::iconSelect2Field(
                                                                $form,
                                                                $ejercicio,
                                                                "[{$id}]frecuencia_veces_semana_id",
                                                                "fa-calendar-week",
                                                                $frecuenciasVecesSemanaMap,
                                                                [
                                                                    "placeholder" => "Frecuencia por semana",
                                                                    "class" => "form-control ejercicio-frecuencia",
                                                                    "id" => "ejercicio-frecuencia-{$id}",
                                                                    "disabled" => !$seleccionado,
                                                                ],
                                                                ["allowClear" => true]
                                                            )->label("Frecuencia semanal", ["class" => "form-label fw-semibold small mb-1"])
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 13: HÁBITOS DE CONSUMO -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingHabitosConsumo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHabitosConsumo" aria-expanded="false" aria-controls="collapseHabitosConsumo">
                    <i class="fas fa-wine-bottle me-2 text-warning"></i> XIII. HÁBITOS DE CONSUMO
                </button>
            </h2>
            <div id="collapseHabitosConsumo" class="accordion-collapse collapse" aria-labelledby="headingHabitosConsumo" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 13</span>
                        <div>
                            <div class="fw-semibold">Habitos de tabaco, alcohol y otras adicciones.</div>
                            <div class="text-muted small">Activa solo lo que aplica y detalla frecuencia o cantidad.</div>
                        </div>
                    </div>

                    <?php
                    $mostrarCigarros = (int)($alumHabitosConsumo->fumas ?? 0) === 1;
                    $mostrarAlcohol = (int)($alumHabitosConsumo->tomas_alcohol ?? 0) === 1;
                    $mostrarAdicciones = (int)($alumHabitosConsumo->tienes_adicciones ?? 0) === 1;
                    ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumHabitosConsumo,
                                'fumas',
                                'fa-smoking',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => 'Fumas?',
                                    'id' => 'alumhabitoconsumo-fumas',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumHabitosConsumo,
                                'tomas_alcohol',
                                'fa-wine-glass',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => 'Consumes alcohol?',
                                    'id' => 'alumhabitoconsumo-tomas_alcohol',
                                ]
                            ) ?>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6 <?= $mostrarCigarros ? '' : 'd-none' ?>" id="habitos-cigarrillos">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumHabitosConsumo,
                                'catalogo_cigarros_dia_id',
                                'fa-smoking',
                                $catalogoCigarrosDiaMap,
                                [
                                    'placeholder' => 'Cigarros por dia',
                                    'id' => 'alumhabitoconsumo-catalogo_cigarros_dia_id',
                                ],
                                ['allowClear' => true]
                            )->label('Si fumas, cuantos cigarros por dia?', ['class' => 'form-label fw-semibold']) ?>
                        </div>
                        <div class="col-md-6 <?= $mostrarAlcohol ? '' : 'd-none' ?>" id="habitos-alcohol">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumHabitosConsumo,
                                'frecuencia_veces_semana_id',
                                'fa-calendar-week',
                                $frecuenciasVecesSemanaMap,
                                [
                                    'placeholder' => 'Frecuencia semanal',
                                    'id' => 'alumhabitoconsumo-frecuencia_veces_semana_id',
                                ],
                                ['allowClear' => true]
                            )->label('Frecuencia de consumo de alcohol', ['class' => 'form-label fw-semibold']) ?>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumHabitosConsumo,
                                'tienes_adicciones',
                                'fa-capsules',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => 'Tienes alguna adiccion?',
                                    'id' => 'alumhabitoconsumo-tienes_adicciones',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6 <?= $mostrarAdicciones ? '' : 'd-none' ?>" id="habitos-adicciones">
                            <?= InputHelper::iconTextField(
                                $form,
                                $alumHabitosConsumo,
                                'especificiar_adiccion',
                                'fa-pen',
                                [
                                    'inputOptions' => [
                                        'placeholder' => 'Especifica la adiccion',
                                        'id' => 'alumhabitoconsumo-especificiar_adiccion',
                                    ],
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 14: RECREACIÓN Y USO DEL TIEMPO LIBRE -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingRecreacion">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRecreacion" aria-expanded="false" aria-controls="collapseRecreacion">
                    <i class="fas fa-gamepad me-2 text-info"></i> XIV. RECREACIÓN Y USO DEL TIEMPO LIBRE
                </button>
            </h2>
            <div id="collapseRecreacion" class="accordion-collapse collapse" aria-labelledby="headingRecreacion" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <?php
                    $mostrarAcceso = (int)($alumRecreacionTiempo->tienes_acceso_internet ?? 0) === 1;
                    $mostrarUsos = $mostrarAcceso && (int)($alumRecreacionTiempo->sabes_usar_internet ?? 0) === 1;
                    ?>

                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 14</span>
                        <div>
                            <div class="fw-semibold">Tu conexión y uso de internet.</div>
                            <div class="text-muted small">Indica si sabes y puedes usar internet y para qué lo utilizas.</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumRecreacionTiempo,
                                'sabes_usar_internet',
                                'fa-laptop',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => ' Sabes usar internet?',
                                    'id' => 'alumrecreaciontiempo-sabes_usar_internet',
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumRecreacionTiempo,
                                'tienes_acceso_internet',
                                'fa-wifi',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => ' Tienes acceso a internet?',
                                    'id' => 'alumrecreaciontiempo-tienes_acceso_internet',
                                ]
                            ) ?>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6 <?= $mostrarAcceso ? '' : 'd-none' ?>" id="recreacion-lugar-acceso">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumRecreacionTiempo,
                                'catalogo_lugares_acceso_principal_id',
                                'fa-map-marker-alt',
                                $catalogoLugaresAccesoMap,
                                [
                                    'placeholder' => 'Lugar principal de acceso',
                                    'id' => 'alumrecreaciontiempo-catalogo_lugares_acceso_principal_id',
                                ],
                                ['allowClear' => true]
                            )->label('¿Dónde te conectas principalmente?', ['class' => 'form-label fw-semibold']) ?>
                        </div>
                    </div>

                    <div id="recreacion-usos" class="mt-4 <?= $mostrarUsos ? '' : 'd-none' ?>">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                            <div>
                                <h5 class="mb-1">Usos principales de internet</h5>
                                <p class="text-muted small mb-0">Activa todas las opciones que apliquen.</p>
                            </div>
                            <span class="badge bg-info-subtle text-info fw-semibold px-3 py-2">Selecciona al menos una</span>
                        </div>

                        <div class="row g-3">
                            <?php foreach ($catalogoUsosInternetMap as $id => $nombre): ?>
                                <?php
                                $id = (int)$id;
                                $checked = in_array($id, $usosInternetSeleccionados, true);
                                ?>
                                <div class="col-lg-6 col-md-12">
                                    <div class="border rounded p-3 h-100">
                                        <div class="form-check form-switch">
                                            <input
                                                class="form-check-input recreacion-uso-checkbox"
                                                type="checkbox"
                                                id="uso-internet-<?= $id ?>"
                                                name="UsosInternet[ids][]"
                                                value="<?= $id ?>"
                                                <?= $checked ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-semibold" for="uso-internet-<?= $id ?>">
                                                <?= Html::encode($nombre) ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 15: ORGANIZACIONES -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOrganizaciones">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrganizaciones" aria-expanded="false" aria-controls="collapseOrganizaciones">
                    <i class="fas fa-handshake me-2 text-primary"></i> XV. PARTICIPACION EN ORGANIZACIONES
                </button>
            </h2>
            <div id="collapseOrganizaciones" class="accordion-collapse collapse" aria-labelledby="headingOrganizaciones" data-bs-parent="#expedienteAccordion">
                <div class="accordion-body">
                    <?php $participaOrganizacion = (int)($alumOrganizacion->participas_organizacion ?? 0) === 1; ?>

                    <div class="section-intro mb-3 d-flex align-items-center gap-2">
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">Paso 15</span>
                        <div>
                            <div class="fw-semibold">Organizaciones y participacion.</div>
                            <div class="text-muted small">Indica si participas y en cuales te encuentras involucrado.</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= InputHelper::iconSelect2Field(
                                $form,
                                $alumOrganizacion,
                                'participas_organizacion',
                                'fa-users',
                                BooleanHelper::options(),
                                [
                                    'placeholder' => 'Participas en alguna organizacion?',
                                    'id' => 'alumorganizacion-participas_organizacion',
                                ]
                            ) ?>
                        </div>
                    </div>

                    <div id="organizaciones-container" class="mt-3 <?= $participaOrganizacion ? '' : 'd-none' ?>">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                            <div>
                                <h5 class="mb-1">Organizaciones en las que participas</h5>
                                <p class="text-muted small mb-0">Selecciona todas las opciones que apliquen.</p>
                            </div>
                            <span class="badge bg-info-subtle text-info fw-semibold px-3 py-2">Selecciona al menos una</span>
                        </div>

                        <?php if (empty($catalogoOrganizacionesGrouped)): ?>
                            <div class="alert alert-warning mb-0">No hay organizaciones registradas en el catalogo.</div>
                        <?php else: ?>
                            <?php foreach ($catalogoOrganizacionesGrouped as $tipoNombre => $organizaciones): ?>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0"><?= Html::encode($tipoNombre) ?></h6>
                                        <span class="text-muted small"><?= count($organizaciones) ?> opciones</span>
                                    </div>
                                    <div class="row g-2">
                                        <?php foreach ($organizaciones as $org): ?>
                                            <?php
                                            $id = (int)($org['id'] ?? 0);
                                            $nombreOrg = trim((string)($org['nombre'] ?? ''));
                                            $checked = in_array($id, $organizacionesSeleccionadas, true);
                                            $esNombreOtro = mb_strtolower($nombreOrg, 'UTF-8') === 'otro';
                                            $esOtro = ($catalogoOrganizacionOtroId !== null && $id === (int)$catalogoOrganizacionOtroId) || $esNombreOtro;
                                            ?>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="organizacion-item border rounded p-3 h-100">
                                                    <div class="form-check">
                                                        <input
                                                            type="checkbox"
                                                            class="form-check-input organizacion-checkbox"
                                                            id="organizacion-<?= $id ?>"
                                                            name="Organizaciones[<?= $id ?>][catalogo_organizaciones_id]"
                                                            value="<?= $id ?>"
                                                            data-es-otro="<?= $esOtro ? '1' : '0' ?>"
                                                            <?= $checked ? 'checked' : '' ?>>
                                                        <label class="form-check-label fw-semibold" for="organizacion-<?= $id ?>"><?= Html::encode($nombreOrg) ?></label>
                                                    </div>
                                                    <?php if ($esOtro): ?>
                                                        <div class="mt-2 organizacion-otro-container <?= $checked ? '' : 'd-none' ?>">
                                                            <label class="form-label small text-muted" for="organizacion-otro-<?= $id ?>">Especifica la organizacion</label>
                                                            <input
                                                                type="text"
                                                                class="form-control organizacion-otro-input"
                                                                id="organizacion-otro-<?= $id ?>"
                                                                name="Organizaciones[<?= $id ?>][otra_organizacion_especificar]"
                                                                value="<?= Html::encode($organizacionesOtroMap[$id] ?? '') ?>"
                                                                <?= $checked ? '' : 'disabled' ?>>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
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
// ?? Registrar JS externo
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
$this->registerJsVar('ORGANIZACION_OTRO_ID', $catalogoOrganizacionOtroId);
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
    '@web/js/expediente/expediente-actividad.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-habitos.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-recreacion.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-organizacion.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/expediente/expediente-focus-errors.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>
