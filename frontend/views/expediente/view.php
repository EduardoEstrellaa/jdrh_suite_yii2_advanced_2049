<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Perfil $perfil */
/** @var common\models\Alumnos $alumno */
/** @var common\models\DatosPersonales $datosPersonales */
/** @var common\models\DatosGenerales $datosGenerales */
/** @var common\models\LugaresNacimiento $lugaresNacimiento */
/** @var common\models\DomiciliosActuales $domiciliosActuales */
/** @var common\models\AlumDatosFamiliares $alumDatosFamiliares */
/** @var common\models\AlumBecas $alumBecas */
/** @var common\models\AlumDependeEconomicamente $alumDependeEconomicamente */
/** @var common\models\AlumDependenEconomica $alumDependenEconomica */
/** @var common\models\AlumVivienda $alumVivienda */
/** @var common\models\AlumTransportes $alumTransportes */
/** @var common\models\AlumHabitosConsumo $alumHabitosConsumo */
/** @var common\models\AlumEstadoSalud $alumEstadoSalud */
/** @var array $dependientes */
/** @var array $catalogoDependenciasOptions */
/** @var array $catalogoBienesOptions */
/** @var array $bienesSeleccionados */
/** @var array $catalogoServiciosViviendaOptions */
/** @var array $serviciosSeleccionados */
/** @var array $tiposViviendasMap */
/** @var array $catalogoTransportesMap */
/** @var array $tiemposRecorridoMap */
/** @var array $catalogoCigarrosDiaMap */
/** @var array $frecuenciasVecesSemanaMap */
/** @var array $serviciosSaludSeleccionados */
/** @var array $catalogoServiciosSaludMap */
/** @var array $usoAnteojosSeleccionados */
/** @var array $catalogoUsoAnteojosMap */
/** @var array $problemasSaludValidos */
/** @var array $catalogoProblemasSaludMap */
/** @var array $tipoGravedadMap */
/** @var array $enfermedadesCronicasSeleccionadas */
/** @var array $catalogoEnfermCronicasMap */
/** @var array $alergiasValidas */
/** @var array $catalogoAlergiasMap */
/** @var array $reaccionesAlergiasSeleccionadas */
/** @var array $catalogoReaccionesAlergicasMap */
/** @var array $tratamientosValidos */
/** @var array $catalogoTratamientosMap */
/** @var array $frecuenciasTiempoMap */
/** @var array $lugaresComerSeleccionados */
/** @var array $catalogoLugaresComerMap */
/** @var array $lugaresComerOtroMap */
/** @var string|null $lugarComerOtro */
/** @var array $consumoAlimentos */
/** @var array $catalogoAlimentosMap */
/** @var array $frecuenciasVecesMap */
/** @var array $usosInternetSeleccionados */
/** @var array $catalogoUsosInternetMap */
/** @var array $organizacionesSeleccionadas */
/** @var array $organizacionesOtroMap */
/** @var array $catalogoOrganizacionesGrouped */
/** @var common\models\AlumOrganizacion $alumOrganizacion */

$this->title = 'Expediente del Estudiante';
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$formatter = Yii::$app->formatter;
$fullName = trim(($perfil->nombre ?? '') . ' ' . ($perfil->apellido ?? ''));
$matricula = $alumno->matricula ?? 'No asignada';
$planName = $alumno->planLicenciaturas->licenciaturas->nombre ?? 'No asignado';
$generationName = $alumno->generaciones->nombre ?? 'No asignada';
$gender = $perfil->generoNombre ?? 'No especificado';
$birthDate = $perfil->fecha_nacimiento ? $formatter->asDate($perfil->fecha_nacimiento, 'long') : 'No especificada';
$civilStatus = $datosGenerales->estadosCiviles->nombre ?? 'No especificado';
$nationality = $datosGenerales->nacionalidades->nombre ?? 'No especificado';
$mayaSpeaker = ((int)($datosGenerales->maya_hablante ?? 0) === 1) ? 'Sí' : 'No';

$boolLabel = static fn($value) => ((int)$value === 1) ? 'Sí' : 'No';
$catalogLabel = static function (array $map, $value, $fallback = 'No especificado') {
    if ($value === null || $value === '') {
        return $fallback;
    }
    $id = (int)$value;
    return $map[$id] ?? $fallback;
};
$listFromMap = static function (?array $ids, array $map, string $fallback = 'Sin registros') {
    if (empty($ids)) {
        return $fallback;
    }

    $labels = [];
    foreach ($ids as $item) {
        $id = (int)$item;
        if ($id <= 0) {
            continue;
        }
        $labels[] = $map[$id] ?? "ID {$id}";
    }

    if (empty($labels)) {
        return $fallback;
    }

    return implode(', ', array_unique($labels));
};
$renderCardList = static function (array $items) {
    $output = '';
    foreach ($items as $entry) {
        $label = Html::encode($entry['label'] ?? '');
        $value = Html::encode($entry['value'] ?? '—');
        $output .= Html::tag('p', "<span>{$label}</span> {$value}", ['class' => 'mb-1 text-muted']);
    }
    return $output;
};

$dependientesList = [];
foreach ($dependientes ?? [] as $dependiente) {
    $catalogoId = (int)($dependiente->catalogo_dependencias_economicas_id ?? 0);
    if ($catalogoId <= 0) {
        continue;
    }
    $label = $catalogoDependenciasOptions[$catalogoId] ?? "Dependiente {$catalogoId}";
    if (!empty($dependiente->otro_especificar)) {
        $label .= ': ' . $dependiente->otro_especificar;
    }
    $dependientesList[] = $label;
}
$dependientesTexto = !empty($dependientesList) ? implode(', ', array_unique($dependientesList)) : 'Sin dependientes registrados';

$tipoBeca = $catalogLabel($tiposBecasMap ?? [], $alumBecas->tipos_becas_id ?? null, 'Sin tipo definido');
$otroTipoBeca = $alumBecas->otro_especificar ?? null;
$tieneBeca = $boolLabel($alumBecas->tiene_beca ?? 0);
$dependenciaPrincipal = $catalogLabel($catalogoDependenciasOptions ?? [], $alumDependeEconomicamente->catalogo_dependencias_economicas_id ?? null);
$dependenciaOtro = $alumDependeEconomicamente->otro_especificar ?? null;
$tieneDependientes = (int)($alumDependenEconomica->tiene_dependientes ?? 0) === 1;

$bienesList = $listFromMap($bienesSeleccionados ?? [], $catalogoBienesOptions ?? [], 'Sin bienes registrados');
$serviciosList = $listFromMap($serviciosSeleccionados ?? [], $catalogoServiciosViviendaOptions ?? [], 'Sin servicios registrados');
$viviendaTipo = $catalogLabel($tiposViviendasMap ?? [], $alumVivienda->tipos_viviendas_id ?? null);
$viveConPadres = $boolLabel($alumVivienda->vives_casa_padres ?? 0);
$residenciaOtro = $alumVivienda->otro_especificar ?? null;
$tipoViviendaOtro = $alumVivienda->otro_tipo_especificar ?? null;

$transporteMedio = $catalogLabel($catalogoTransportesMap ?? [], $alumTransportes->catalogo_transportes_id ?? null);
$transporteTiempo = $catalogLabel($tiemposRecorridoMap ?? [], $alumTransportes->tiempo_recorrido_transporte_id ?? null);

$problemasList = [];
foreach ($problemasSaludValidos ?? [] as $problema) {
    $nombreProblema = $catalogLabel($catalogoProblemasSaludMap ?? [], $problema->catalogo_problemas_salud_id ?? null, 'Problema sin catalogar');
    $gravedad = $catalogLabel($tipoGravedadMap ?? [], $problema->tipo_gravedad_id ?? null);
    $detalle = !empty($problema->otro_especificar) ? ': ' . $problema->otro_especificar : '';
    $problemasList[] = trim("{$nombreProblema} ({$gravedad}){$detalle}");
}

$enfermedadesList = [];
foreach ($enfermedadesCronicasSeleccionadas ?? [] as $id => $enfermedad) {
    $nombre = $catalogLabel($catalogoEnfermCronicasMap ?? [], $id ?? null, 'Enfermedad sin catalogar');
    $otro = $enfermedad->otro_especificar ?? null;
    $enfermedadesList[] = $otro ? "{$nombre}: {$otro}" : $nombre;
}

$alergiasList = [];
foreach ($alergiasValidas ?? [] as $alergia) {
    $catalogoId = $alergia->catalogo_alergias_id ?? null;
    $nombre = $catalogLabel($catalogoAlergiasMap ?? [], $catalogoId, 'Alergia sin catalogar');
    $gravedad = $catalogLabel($tipoGravedadMap ?? [], $alergia->tipo_gravedad_id ?? null);
    $reacciones = $reaccionesAlergiasSeleccionadas[$catalogoId ?? 0] ?? [];
    $nombresReacciones = [];
    foreach ($reacciones as $reaccionId) {
        $nombresReacciones[] = $catalogoReaccionesAlergicasMap[$reaccionId] ?? "Reacción {$reaccionId}";
    }
    $detalleReacciones = !empty($nombresReacciones) ? ' · Reacciones: ' . implode(', ', array_unique($nombresReacciones)) : '';
    $alergiasList[] = trim("{$nombre} ({$gravedad}){$detalleReacciones}");
}

$tratamientosList = [];
foreach ($tratamientosValidos ?? [] as $tratamiento) {
    $tipo = $catalogLabel($catalogoTratamientosMap ?? [], $tratamiento->catalogo_tratamientos_id ?? null, 'Tratamiento sin catalogar');
    $frecuencia = $catalogLabel($frecuenciasTiempoMap ?? [], $tratamiento->frecuencia_tiempo_id ?? null, 'Frecuencia no registrada');
    $inicio = $tratamiento->fecha_inicio ? $formatter->asDate($tratamiento->fecha_inicio, 'long') : 'Inicio no registrado';
    $fin = $tratamiento->fecha_fin ? $formatter->asDate($tratamiento->fecha_fin, 'long') : 'Fin no registrado';
    $tratamientosList[] = "{$tipo} ({$frecuencia}) · {$inicio} — {$fin}";
}

$lugaresComerTexto = $listFromMap($lugaresComerSeleccionados ?? [], $catalogoLugaresComerMap ?? [], 'Sin lugares registrados');
$lugaresComerExtras = [];
foreach ($lugaresComerOtroMap ?? [] as $catalogoId => $texto) {
    $etiqueta = $catalogLabel($catalogoLugaresComerMap ?? [], $catalogoId ?? null, 'Otro lugar');
    $lugaresComerExtras[] = "{$etiqueta}: {$texto}";
}
if (!empty($lugaresComerExtras)) {
    $lugaresComerTexto .= ' · ' . implode(' · ', array_unique($lugaresComerExtras));
}
if (!empty($lugarComerOtro)) {
    $lugaresComerTexto .= ' · Otro: ' . $lugarComerOtro;
}

$consumoAlimentosDetalles = [];
foreach ($consumoAlimentos ?? [] as $consumo) {
    $alimento = $catalogLabel($catalogoAlimentosMap ?? [], $consumo->catalogo_alimentos_id ?? null, 'Alimento sin catalogar');
    $frecuencia = $catalogLabel($frecuenciasVecesMap ?? [], $consumo->frecuencia_veces_id ?? null, '');
    $consumoAlimentosDetalles[] = $frecuencia ? "{$alimento} ({$frecuencia})" : $alimento;
}
$consumoAlimentosTexto = !empty($consumoAlimentosDetalles) ? implode(' · ', array_unique($consumoAlimentosDetalles)) : 'Sin registros';

$usosInternetTexto = $listFromMap($usosInternetSeleccionados ?? [], $catalogoUsosInternetMap ?? [], 'Sin registros');
$participaOrganizacion = (int)($alumOrganizacion->participas_organizacion ?? 0) === 1;

$summaryCards = [
    [
        'title' => 'Identidad',
        'icon' => 'fas fa-id-card',
        'items' => [
            ['label' => 'Nombre', 'value' => $fullName ?: 'No disponible'],
            ['label' => 'Matrícula', 'value' => $matricula],
            ['label' => 'Programa', 'value' => $planName],
            ['label' => 'Generación', 'value' => $generationName],
            ['label' => 'Nacimiento', 'value' => $birthDate],
        ],
    ],
    [
        'title' => 'Contacto',
        'icon' => 'fas fa-phone',
        'items' => [
            ['label' => 'Correo', 'value' => $datosGenerales->email_personal ?? 'No registrado'],
            ['label' => 'Teléfono', 'value' => $datosGenerales->tlf_personal ?? 'No registrado'],
            ['label' => 'Emergencia', 'value' => $datosGenerales->tlf_emergencia ?? 'No registrado'],
        ],
    ],
    [
        'title' => 'Estado y lengua',
        'icon' => 'fas fa-globe',
        'items' => [
            ['label' => 'Género', 'value' => $gender],
            ['label' => 'Estado civil', 'value' => $civilStatus],
            ['label' => 'Nacionalidad', 'value' => $nationality],
            ['label' => 'Habla maya', 'value' => $mayaSpeaker],
        ],
    ],
];

$this->registerCss(<<<'CSS'
.expediente-card {
    border-radius: 1rem;
    transition: transform .16s ease, box-shadow .16s ease;
}
.expediente-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 35px rgba(15, 15, 15, .12);
}
.expediente-card .card-body {
    padding: 1.35rem;
}
.expediente-card .card-title {
    font-size: .95rem;
    letter-spacing: .02em;
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 1rem;
}
.expediente-card p span {
    display: inline-block;
    min-width: 120px;
    font-weight: 600;
}
.expediente-section {
    margin-bottom: 2rem;
}
.expediente-section ul {
    padding-left: 1.25rem;
}
.expediente-section ul li {
    margin-bottom: .35rem;
}
@media (max-width: 768px) {
    .expediente-card .card-body {
        padding: 1rem;
    }
    .expediente-card p span {
        min-width: 90px;
    }
}
CSS
);

?>
<div class="expediente-view container mt-4">

    <h2 class="text-center mb-3 text-primary">
        <i class="fas fa-folder-open"></i> <?= Html::encode($this->title) ?>
    </h2>

    <div class="mb-4 text-center">
        <?= Html::a('Actualizar', ['update', 'perfil_id' => $perfil->id], ['class' => 'btn btn-primary me-2']) ?>
        <?= Html::a('<i class="fas fa-file-pdf"></i> PDF', ['pdf'], [
            'class' => 'btn btn-danger me-2',
            'target' => '_blank',
            'title' => 'Abrir expediente en PDF'
        ]) ?>
        <?= Html::a('<i class="fas fa-trash-alt"></i> Eliminar', [
            'delete',
            'perfil_id' => $perfil->id
        ], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que deseas eliminar este expediente?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <div class="expediente-section expediente-summary row row-cols-1 row-cols-md-3 g-3 mb-4">
        <?php foreach ($summaryCards as $card): ?>
            <div class="col">
                <div class="card expediente-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="<?= Html::encode($card['icon'] ?? '') ?>"></i>
                            <?= Html::encode($card['title'] ?? '') ?>
                        </h5>
                        <?= $renderCardList($card['items'] ?? []) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="expediente-section row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h4><i class="fas fa-user text-primary"></i> Documentos</h4>
                    <?= DetailView::widget([
                        'model' => $datosPersonales,
                        'attributes' => [
                            [
                                'attribute' => 'curp',
                                'label' => 'CURP',
                                'value' => $datosPersonales->curp ?? 'No registrado',
                            ],
                            [
                                'attribute' => 'nss',
                                'label' => 'NSS',
                                'value' => $datosPersonales->nss ?? 'No registrado',
                            ],
                            [
                                'attribute' => 'rfc',
                                'label' => 'RFC',
                                'value' => $datosPersonales->rfc ?? 'No registrado',
                            ],
                        ],
                        'options' => ['class' => 'table table-bordered table-striped mb-0'],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h4><i class="fas fa-phone text-success"></i> Datos generales y contacto</h4>
                    <?= DetailView::widget([
                        'model' => $datosGenerales,
                        'attributes' => [
                            [
                                'label' => 'Teléfono personal',
                                'value' => $datosGenerales->tlf_personal ?? 'No registrado',
                            ],
                            [
                                'label' => 'Teléfono de emergencia',
                                'value' => $datosGenerales->tlf_emergencia ?? 'No registrado',
                            ],
                            [
                                'label' => 'Estado civil',
                                'value' => $civilStatus,
                            ],
                            [
                                'label' => 'Nacionalidad',
                                'value' => $nationality,
                            ],
                            [
                                'label' => 'Habla maya',
                                'value' => $mayaSpeaker,
                            ],
                        ],
                        'options' => ['class' => 'table table-bordered table-striped mb-0'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="expediente-section row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h4><i class="fas fa-birthday-cake text-warning"></i> Lugar de nacimiento</h4>
                    <?= DetailView::widget([
                        'model' => $lugaresNacimiento,
                        'attributes' => [
                            [
                                'attribute' => 'entidades_federativas_id',
                                'label' => 'Entidad federativa',
                                'value' => $lugaresNacimiento->entidadesFederativas->nombre ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'municipios_id',
                                'label' => 'Municipio',
                                'value' => $lugaresNacimiento->municipios->nombre ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'localidad',
                                'label' => 'Localidad',
                                'value' => $lugaresNacimiento->localidad ?? 'No especificado',
                            ],
                        ],
                        'options' => ['class' => 'table table-bordered table-striped mb-0'],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h4><i class="fas fa-home text-success"></i> Domicilio actual</h4>
                    <?= DetailView::widget([
                        'model' => $domiciliosActuales,
                        'attributes' => [
                            [
                                'attribute' => 'entidades_federativas_id',
                                'label' => 'Entidad federativa',
                                'value' => $domiciliosActuales->entidadesFederativas->nombre ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'municipios_id',
                                'label' => 'Municipio',
                                'value' => $domiciliosActuales->municipios->nombre ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'localidad',
                                'label' => 'Localidad',
                                'value' => $domiciliosActuales->localidad ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'calle',
                                'label' => 'Calle',
                                'value' => $domiciliosActuales->calle ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'numero_exterior',
                                'label' => 'Número exterior',
                                'value' => $domiciliosActuales->numero_exterior ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'numero_interior',
                                'label' => 'Número interior',
                                'value' => $domiciliosActuales->numero_interior ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'colonia',
                                'label' => 'Colonia',
                                'value' => $domiciliosActuales->colonia ?? 'No especificado',
                            ],
                            [
                                'attribute' => 'codigo_postal',
                                'label' => 'Código postal',
                                'value' => $domiciliosActuales->codigo_postal ?? 'No especificado',
                            ],
                        ],
                        'options' => ['class' => 'table table-bordered table-striped mb-0'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="expediente-section row g-3">
        <div class="col-md-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Familia</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <p class="mb-1"><strong>Padre:</strong> <?= Html::encode($alumDatosFamiliares->padre_nombre ?? 'No registrado') ?></p>
                            <p class="mb-1"><strong>Ocupación:</strong> <?= Html::encode($alumDatosFamiliares->padre_ocupacion ?? 'No especificado') ?></p>
                            <p class="mb-0"><strong>Habla maya:</strong> <?= Html::encode($boolLabel($alumDatosFamiliares->padre_mayahablante ?? 0)) ?></p>
                        </div>
                        <div class="col-6">
                            <p class="mb-1"><strong>Madre:</strong> <?= Html::encode($alumDatosFamiliares->madre_nombre ?? 'No registrado') ?></p>
                            <p class="mb-1"><strong>Ocupación:</strong> <?= Html::encode($alumDatosFamiliares->madre_ocupacion ?? 'No especificado') ?></p>
                            <p class="mb-0"><strong>Habla maya:</strong> <?= Html::encode($boolLabel($alumDatosFamiliares->madre_mayahablante ?? 0)) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card expediente-card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Economía</h5>
                    <p class="mb-1"><strong>Dependencia principal:</strong> <?= Html::encode($dependenciaPrincipal) ?></p>
                    <?php if ($dependenciaOtro): ?>
                        <p class="mb-1"><strong>Otro:</strong> <?= Html::encode($dependenciaOtro) ?></p>
                    <?php endif; ?>
                    <p class="mb-1"><strong>¿Tiene dependientes?</strong> <?= $tieneDependientes ? 'Sí' : 'No' ?></p>
                    <p class="mb-0"><strong>Dependientes registrados:</strong> <?= Html::encode($dependientesTexto) ?></p>
                    <hr>
                    <p class="mb-1"><strong>¿Tiene beca?</strong> <?= Html::encode($tieneBeca) ?></p>
                    <p class="mb-1"><strong>Tipo de beca:</strong> <?= Html::encode($tipoBeca) ?></p>
                    <?php if ($otroTipoBeca): ?>
                        <p class="mb-0"><strong>Otro:</strong> <?= Html::encode($otroTipoBeca) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="expediente-section row g-3">
        <div class="col-md-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Vivienda</h5>
                    <p class="mb-1"><strong>Vive con sus padres:</strong> <?= Html::encode($viveConPadres) ?></p>
                    <?php if (!$viveConPadres && $residenciaOtro): ?>
                        <p class="mb-1"><strong>Especifica con quién vive:</strong> <?= Html::encode($residenciaOtro) ?></p>
                    <?php endif; ?>
                    <p class="mb-1"><strong>Tipo de vivienda:</strong> <?= Html::encode($viviendaTipo) ?></p>
                    <?php if ($tipoViviendaOtro): ?>
                        <p class="mb-1"><strong>Otro tipo:</strong> <?= Html::encode($tipoViviendaOtro) ?></p>
                    <?php endif; ?>
                    <p class="mb-0"><strong>Bienes:</strong> <?= Html::encode($bienesList) ?></p>
                    <p class="mb-0"><strong>Servicios:</strong> <?= Html::encode($serviciosList) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Transporte</h5>
                    <p class="mb-1"><strong>Medio de transporte:</strong> <?= Html::encode($transporteMedio) ?></p>
                    <p class="mb-0"><strong>Tiempo de recorrido:</strong> <?= Html::encode($transporteTiempo) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="expediente-section row g-3">
        <div class="col-lg-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Hábitos</h5>
                    <p class="mb-1"><strong>Fumas:</strong> <?= Html::encode($boolLabel($alumHabitosConsumo->fumas ?? 0)) ?></p>
                    <?php if ((int)($alumHabitosConsumo->fumas ?? 0) === 1): ?>
                        <p class="mb-1"><strong>Cigarros al día:</strong> <?= Html::encode($catalogLabel($catalogoCigarrosDiaMap ?? [], $alumHabitosConsumo->catalogo_cigarros_dia_id ?? null)) ?></p>
                    <?php endif; ?>
                    <p class="mb-1"><strong>Consumes alcohol:</strong> <?= Html::encode($boolLabel($alumHabitosConsumo->tomas_alcohol ?? 0)) ?></p>
                    <?php if ((int)($alumHabitosConsumo->tomas_alcohol ?? 0) === 1): ?>
                        <p class="mb-1"><strong>Frecuencia semanal:</strong> <?= Html::encode($catalogLabel($frecuenciasVecesSemanaMap ?? [], $alumHabitosConsumo->frecuencia_veces_semana_id ?? null)) ?></p>
                    <?php endif; ?>
                    <p class="mb-1"><strong>Tiene adicciones:</strong> <?= Html::encode($boolLabel($alumHabitosConsumo->tienes_adicciones ?? 0)) ?></p>
                    <?php if (!empty($alumHabitosConsumo->especificiar_adiccion)): ?>
                        <p class="mb-0"><strong>Especificar:</strong> <?= Html::encode($alumHabitosConsumo->especificiar_adiccion) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Salud</h5>
                    <p class="mb-1"><strong>Servicios de salud:</strong> <?= Html::encode($listFromMap($serviciosSaludSeleccionados ?? [], $catalogoServiciosSaludMap ?? [])) ?></p>
                    <p class="mb-1"><strong>Uso de anteojos:</strong> <?= Html::encode($listFromMap($usoAnteojosSeleccionados ?? [], $catalogoUsoAnteojosMap ?? [])) ?></p>
                    <p class="mb-1"><strong>Problemas de salud:</strong></p>
                    <?php if (!empty($problemasList)): ?>
                        <ul class="mb-1">
                            <?php foreach ($problemasList as $item): ?>
                                <li><?= Html::encode($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-1">Sin problemas registrados.</p>
                    <?php endif; ?>
                    <p class="mb-1"><strong>Enfermedades crónicas:</strong></p>
                    <?php if (!empty($enfermedadesList)): ?>
                        <ul class="mb-1">
                            <?php foreach ($enfermedadesList as $item): ?>
                                <li><?= Html::encode($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-1">Sin enfermedades registradas.</p>
                    <?php endif; ?>
                    <p class="mb-1"><strong>Alergias:</strong></p>
                    <?php if (!empty($alergiasList)): ?>
                        <ul class="mb-1">
                            <?php foreach ($alergiasList as $item): ?>
                                <li><?= Html::encode($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-1">Sin alergias registradas.</p>
                    <?php endif; ?>
                    <p class="mb-1"><strong>Tratamientos:</strong></p>
                    <?php if (!empty($tratamientosList)): ?>
                        <ul class="mb-1">
                            <?php foreach ($tratamientosList as $item): ?>
                                <li><?= Html::encode($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-1">Sin tratamientos activos.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="expediente-section row g-3">
        <div class="col-lg-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Alimentación</h5>
                    <p class="mb-1"><strong>Lugares de comida:</strong> <?= Html::encode($lugaresComerTexto) ?></p>
                    <p class="mb-0"><strong>Consumo de alimentos:</strong> <?= Html::encode($consumoAlimentosTexto) ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card expediente-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Recreación</h5>
                    <p class="mb-0"><strong>Usos de internet:</strong> <?= Html::encode($usosInternetTexto) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="expediente-section">
        <div class="card expediente-card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users text-info"></i> Organizaciones</h5>
                <?php
                $organizacionNombres = [];
                $organizacionesOtroMap = $organizacionesOtroMap ?? [];
                foreach (($catalogoOrganizacionesGrouped ?? []) as $grupo) {
                    foreach ($grupo as $org) {
                        $orgId = (int)($org['id'] ?? 0);
                        $organizacionNombres[$orgId] = $org['nombre'] ?? '';
                    }
                }
                ?>
                <p class="mb-1"><strong>Participas en organizaciones:</strong> <?= $participaOrganizacion ? 'Sí' : 'No' ?></p>
                <?php if ($participaOrganizacion): ?>
                    <?php if (!empty($organizacionesSeleccionadas)): ?>
                        <ul>
                            <?php foreach ($organizacionesSeleccionadas as $orgId): ?>
                                <?php
                                $nombre = $organizacionNombres[(int)$orgId] ?? ('Organización ' . (int)$orgId);
                                $otro = $organizacionesOtroMap[(int)$orgId] ?? null;
                                ?>
                                <li>
                                    <?= Html::encode($nombre) ?><?= $otro ? ': ' . Html::encode($otro) : '' ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">Sin organizaciones registradas.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
