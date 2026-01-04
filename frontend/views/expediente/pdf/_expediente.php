<?php

/** @var $alumno common\models\Alumnos */
/** @var $perfil common\models\Perfil */

use Yii;
use frontend\services\pdf\PdfValueFormatter as F;
use common\models\TiempoRecorridoTransporte;

function boxTitle($t)
{
    return "<h2>{$t}</h2>";
}
function hrBreak()
{
    return "<div class='section-divider'></div>";
}


?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?= Yii::getAlias('@frontend/web/css/pdf-expediente.css') ?>">
</head>

<body>
    <div class="pdf-wrapper">
        <header class="pdf-header">
            <div>
                <p class="badge">Expediente oficial</p>
                <h1>Expediente del Alumno</h1>
            </div>
            <p class="muted pdf-header__date">Generado el: <?= F::date(date('Y-m-d')) ?></p>
        </header>

        <!-- ========================= -->
        <!-- I. DATOS ACADEMICOS -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("I. Datos academicos") ?>
            <table>
                <tr>
                    <td class="label">Matrícula</td>
                    <td class="value"><?= F::fmt($alumno->matricula ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Licenciatura</td>
                    <td class="value"><?= F::fmt($alumno->planLicenciaturas->licenciaturas->nombre ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Generación</td>
                    <td class="value"><?= F::fmt($alumno->generaciones->nombre ?? null) ?></td>
                </tr>
            </table>
        </div>

        <!-- ========================= -->
        <!-- II. DATOS PERSONALES -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("II. Datos personales") ?>
            <h3>Perfil institucional</h3>
            <table>
                <tr>
                    <td class="label">Nombre</td>
                    <td class="value">
                        <?php
                        $nombreCompleto = trim(($perfil->nombre ?? '') . ' ' . ($perfil->apellido ?? ''));
                        echo F::fmt($nombreCompleto ?: null);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="label">Fecha nacimiento</td>
                    <td class="value"><?= F::date($perfil->fecha_nacimiento ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Género</td>
                    <td class="value"><?= F::fmt($perfil->genero->genero_nombre ?? null) ?></td>
                </tr>
            </table>

            <?= hrBreak() ?>

            <h3>Identificacion oficial</h3>
            <table>
                <tr>
                    <td class="label">CURP</td>
                    <td class="value"><?= F::fmt($datosPersonales->curp ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Número de Seguro Social</td>
                    <td class="value"><?= F::fmt($datosPersonales->nss ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">RFC</td>
                    <td class="value"><?= F::fmt($datosPersonales->rfc ?? null) ?></td>
                </tr>
            </table>

            <?= hrBreak() ?>

            <h3>Contacto y datos generales</h3>
            <table>
                <tr>
                    <td class="label">Teléfono personal</td>
                    <td class="value"><?= F::fmt($datosGenerales->tlf_personal ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Teléfono de emergencia</td>
                    <td class="value"><?= F::fmt($datosGenerales->tlf_emergencia ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Correo electrónico personal</td>
                    <td class="value"><?= F::fmt($datosGenerales->email_personal ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Estado civil</td>
                    <td class="value"><?= F::fmt($datosGenerales->estadosCiviles->nombre ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Nacionalidad</td>
                    <td class="value"><?= F::fmt($datosGenerales->nacionalidades->nombre ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">¿Habla maya?</td>
                    <td class="value"><?= F::bool($datosGenerales->maya_hablante ?? null) ?></td>
                </tr>
            </table>

            <?= hrBreak() ?>

            <h3>Lugar de nacimiento</h3>
            <table>
                <tr>
                    <td class="label">Entidad federativa</td>
                    <td class="value"><?= F::fmt($lugaresNacimiento->entidadesFederativas->nombre ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Municipio</td>
                    <td class="value"><?= F::fmt($lugaresNacimiento->municipios->nombre ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Localidad</td>
                    <td class="value"><?= F::fmt($lugaresNacimiento->localidad ?? null) ?></td>
                </tr>
            </table>

            <?= hrBreak() ?>

            <h3>Domicilio actual</h3>
            <table>
                <tr>
                    <td class="label">Entidad federativa</td>
                    <td class="value"><?= F::fmt($domiciliosActuales->entidadesFederativas->nombre ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Municipio</td>
                    <td class="value"><?= F::fmt($domiciliosActuales->municipios->nombre ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Localidad</td>
                    <td class="value"><?= F::fmt($domiciliosActuales->localidad ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Calle</td>
                    <td class="value"><?= F::fmt($domiciliosActuales->calle ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Número exterior</td>
                    <td class="value"><?= F::fmt($domiciliosActuales->numero_exterior ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Número interior</td>
                    <td class="value"><?= F::fmt($domiciliosActuales->numero_interior ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Colonia</td>
                    <td class="value"><?= F::fmt($domiciliosActuales->colonia ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Código postal</td>
                    <td class="value"><?= F::fmt($domiciliosActuales->codigo_postal ?? null) ?></td>
                </tr>
            </table>
        </div>

        <!-- ========================= -->
        <!-- III. DATOS FAMILIARES -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("III. Datos familiares") ?>

            <h3>Datos del padre</h3>
            <table>
                <tr>
                    <td class="label">Nombre completo</td>
                    <td class="value"><?= F::fmt($familiaPadre['nombre_completo'] ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Ocupación actual</td>
                    <td class="value"><?= F::fmt($familiaPadre['ocupacion'] ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">¿Habla maya? (padre)</td>
                    <td class="value"><?= F::bool($familiaPadre['habla_maya'] ?? null) ?></td>
                </tr>
            </table>

            <?= hrBreak() ?>

            <h3>Datos de la madre</h3>
            <table>
                <tr>
                    <td class="label">Nombre completo</td>
                    <td class="value"><?= F::fmt($familiaMadre['nombre_completo'] ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">Ocupación actual</td>
                    <td class="value"><?= F::fmt($familiaMadre['ocupacion'] ?? null) ?></td>
                </tr>
                <tr>
                    <td class="label">¿Habla maya? (madre)</td>
                    <td class="value"><?= F::bool($familiaMadre['habla_maya'] ?? null) ?></td>
                </tr>
            </table>
        </div>



        <div class="page-break"></div>

        <!-- ========================= -->
        <!-- IV. INFORMACION DE BECAS -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("IV. Informacion de becas") ?>

            <?php
            $b = $becaPdf ?? [];

            $tiene = (int)($b['tieneBeca'] ?? 0);
            $tipo  = $b['tipoTxt'] ?? null;
            $otro  = $b['otroTxt'] ?? null;
            $esOtro = !empty($b['esOtro'] ?? false);
            $otroTrim = trim((string)$otro);
            $det   = $b['detalle'] ?? null;
            ?>

            <table>
                <tr>
                    <td class="label">¿Cuenta con beca?</td>
                    <td class="value"><?= F::bool($tiene) ?></td>
                </tr>

                <?php if ($tiene === 1): ?>
                    <tr>
                        <td class="label">Tipo de beca</td>
                        <td class="value">
                            <?php if (!empty($tipo)): ?>
                                <?= F::fmt($tipo) ?>
                            <?php else: ?>
                                <span class="muted">Sin tipo de beca registrado.</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <?php
                    $esOtroBeca = $esOtro && $otroTrim !== '';
                    if ($esOtroBeca): ?>
                        <tr>
                            <td class="label">Especificación</td>
                            <td class="value"><?= F::fmt($otroTrim) ?></td>
                        </tr>
                    <?php endif; ?>

                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted"><?= F::fmt($det) ?></span></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>



        <!-- ========================= -->
        <!-- V. HIJOS -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("V. Informacion de hijos") ?>

            <?php
            $tieneHijos = (int)($alumInfoHijos->tiene_hijos ?? 0);
            $cantidadHijos = $alumInfoHijos->cantidad_hijos ?? null;

            // Si por algún motivo tiene_hijos=0 pero vienen edades, mantenemos consistencia:
            $hayListado = !empty($edadesHijos);
            if ($tieneHijos !== 1 && $hayListado) {
                $tieneHijos = 1;
            }
            ?>

            <table>
                <tr>
                    <td class="label">¿Tiene hijos?</td>
                    <td class="value"><?= F::bool($tieneHijos) ?></td>
                </tr>

                <?php if ($tieneHijos === 1): ?>
                    <tr>
                        <td class="label">Cantidad de hijos</td>
                        <td class="value"><?= F::fmt($cantidadHijos) ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No registra hijos.</span></td>
                    </tr>
                <?php endif; ?>
            </table>

            <?php if ($tieneHijos === 1): ?>
                <?= hrBreak() ?>

                <?php if (!empty($edadesHijos)): ?>
                    <h3>Listado de hijos</h3>
                    <table>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nombre completo</th>
                            <th style="width:120px;">Fecha nacimiento</th>
                            <th style="width:60px;">Edad</th>
                        </tr>
                        <?php foreach ($edadesHijos as $i => $h): ?>
                            <?php
                            $nombreCompletoHijo = trim(($h->nombre ?? '') . ' ' . ($h->apellido_paterno ?? '') . ' ' . ($h->apellido_materno ?? ''));
                            $edad = F::ageYears($h->fecha_nacimiento ?? null);
                            ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= F::fmt($nombreCompletoHijo ?: null) ?></td>
                                <td><?= F::date($h->fecha_nacimiento ?? null) ?></td>
                                <td><?= F::fmt($edad !== null ? (string)$edad : null) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p class="muted">No hay registros detallados de hijos.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>


        <!-- ========================= -->
        <!-- VI. SITUACION SOCIOECONOMICA -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("VI. Situacion socioeconomica") ?>

            <?php
            $eco = $ecoPdf ?? [];
            $dep = $eco['dependencia'] ?? [];
            $dps = $eco['dependientes'] ?? [];
            ?>

            <h3>Dependencia economica</h3>
            <table>
                <?php if (!empty($dep['hay'])): ?>
                    <tr>
                        <td class="label">¿De quién depende tu economía?</td>
                        <td class="value"><?= F::fmt($dep['deQuienTxt'] ?? null) ?></td>
                    </tr>
                    <?php if (!empty($dep['otroTxt'])): ?>
                        <tr>
                            <td class="label">Especificación</td>
                            <td class="value"><?= F::fmt($dep['otroTxt']) ?></td>
                        </tr>
                    <?php endif; ?>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted"><?= F::fmt($dep['detalle'] ?? null) ?></span></td>
                    </tr>
                <?php endif; ?>
            </table>

            <?= hrBreak() ?>

            <h3>Dependientes economicos</h3>
            <table>
                <tr>
                    <td class="label">¿Tienes dependientes?</td>
                    <td class="value"><?= F::bool((int)($dps['tiene'] ?? 0)) ?></td>
                </tr>

                <?php if (!empty($dps['hay'])): ?>
                    <?php if (!empty($dps['listaTxt'])): ?>
                        <tr>
                            <td class="label">¿Quiénes dependen de ti?</td>
                            <td class="value"><?= F::fmt($dps['listaTxt']) ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if (!empty($dps['otroTxt'])): ?>
                        <tr>
                            <td class="label">Especificación</td>
                            <td class="value"><?= F::fmt($dps['otroTxt']) ?></td>
                        </tr>
                    <?php endif; ?>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted"><?= F::fmt($dps['detalle'] ?? null) ?></span></td>
                    </tr>
                <?php endif; ?>
            </table>

            <?= hrBreak() ?>

            <h3>Trabajo</h3>

            <?php
            $tieneTrabajo = (int)($alumTrabajo->tiene_trabajo ?? 0);

            $empresa = trim((string)($alumTrabajo->nombre_empresa ?? '')) ?: null;
            $puesto  = trim((string)($alumTrabajo->puesto_ocupacion ?? '')) ?: null;

            $entrada = $alumTrabajo->horario_entrada ?? null;
            $salida  = $alumTrabajo->horario_salida ?? null;
            ?>

            <table>
                <tr>
                    <td class="label">¿Tienes trabajo?</td>
                    <td class="value"><?= F::bool($tieneTrabajo) ?></td>
                </tr>

                <?php if ($tieneTrabajo === 1): ?>
                    <tr>
                        <td class="label">Empresa</td>
                        <td class="value"><?= F::fmt($empresa) ?></td>
                    </tr>
                    <tr>
                        <td class="label">Puesto / Ocupación</td>
                        <td class="value"><?= F::fmt($puesto) ?></td>
                    </tr>
                    <tr>
                        <td class="label">Hora de entrada</td>
                        <td class="value"><?= F::time($entrada) ?></td>
                    </tr>
                    <tr>
                        <td class="label">Hora de salida</td>
                        <td class="value"><?= F::time($salida) ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No cuenta con empleo registrado.</span></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>


        <!-- ========================= -->
        <!-- VII. BIENES Y SERVICIOS DE LA VIVIENDA -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("VII. Bienes y servicios de la vivienda") ?>

            <?php
            $v = $viviendaPdf ?? [];
            $hay = (bool)($v['hayViviendaInfo'] ?? false);
            ?>

            <?php if (!$hay): ?>
                <table>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No registró información de vivienda y servicios.</span></td>
                    </tr>
                </table>
            <?php else: ?>

                <h3>Vivienda</h3>
                <table>
                    <tr>
                        <td class="label">¿Vives con tus padres?</td>
                        <td class="value"><?= F::bool($v['viveConPadres'] ?? null) ?></td>
                    </tr>
                    <?php if (!empty($v['viveConEspecifica'])): ?>
                        <tr>
                            <td class="label">Especifica</td>
                            <td class="value"><?= F::fmt($v['viveConEspecifica']) ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="label">Tipo de vivienda</td>
                        <td class="value"><?= F::map(($v['tipoViviendaId'] ?? null), $tiposViviendasMap ?? []) ?></td>
                    </tr>
                    <?php
                    $tipoOtroId = $tipoViviendaOtroId ?? null;
                    $esTipoOtro = $tipoOtroId !== null && (int)($v['tipoViviendaId'] ?? 0) === (int)$tipoOtroId;
                    if ($esTipoOtro && !empty($v['tipoViviendaOtro'])): ?>
                        <tr>
                            <td class="label">Especifica “Otro”</td>
                            <td class="value"><?= F::fmt($v['tipoViviendaOtro']) ?></td>
                        </tr>
                    <?php endif; ?>
                </table>

                <?= hrBreak() ?>

                <h3>Bienes de la vivienda</h3>
                <?php if (!empty($v['bienesSeleccionados']) || !empty($v['bienesOtro'])): ?>
                    <table>
                        <tr>
                            <td class="label">Seleccionados</td>
                            <td class="value">
                                <?= F::listByIds($v['bienesSeleccionados'] ?? [], $catalogoBienesOptions ?? []) ?>
                                <?php if (!empty($v['bienesOtro'])): ?>
                                    <br><span class="muted">Otro:</span> <?= F::fmt($v['bienesOtro']) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <p class="muted">Sin bienes registrados.</p>
                <?php endif; ?>

                <?= hrBreak() ?>

                <h3>Servicios de la vivienda</h3>
                <?php if (!empty($v['serviciosSeleccionados']) || !empty($v['serviciosOtro'])): ?>
                    <table>
                        <tr>
                            <td class="label">Servicios disponibles</td>
                            <td class="value">
                                <?= F::listByIds($v['serviciosSeleccionados'] ?? [], $catalogoServiciosViviendaOptions ?? []) ?>
                                <?php if (!empty($v['serviciosOtro'])): ?>
                                    <br><span class="muted">Otro:</span> <?= F::fmt($v['serviciosOtro']) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <p class="muted">Sin servicios registrados.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>


        <!-- ========================= -->
        <!-- VIII. BIENES PERSONALES -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("VIII. Bienes personales") ?>
            <?php if (empty($bienesPersonalesSeleccionados)): ?>
                <table>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">Sin bienes registrados.</span></td>
                    </tr>
                </table>
            <?php else: ?>
                <table>
                    <tr>
                        <td class="label">Bienes personales</td>
                        <td class="value"><?= F::listByIds($bienesPersonalesSeleccionados ?? [], $catalogoBienesPersonalesOptions ?? []) ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        </div>

        <div class="page-break"></div>

        <!-- ========================= -->
        <!-- IX. TRANSPORTE Y TIEMPOS -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("IX. Transporte y tiempos") ?>

            <?php
            $transporteId = F::firstProp($alumTransportes ?? null, ['catalogo_transportes_id', 'catalogo_transporte_id', 'transportes_id', 'transporte_id', 'medio_transporte_id']);
            $tiempoId     = F::firstProp($alumTransportes ?? null, ['tiempo_recorrido_transporte_id', 'tiempo_recorrido_id', 'tiempo_id']);

            $transporteTxt = null;
            if (!empty($alumTransportes) && !empty($alumTransportes->catalogoTransportes->nombre ?? null)) {
                $transporteTxt = $alumTransportes->catalogoTransportes->nombre;
            } else {
                $transporteTxt = ($transporteId !== null)
                    ? F::map($transporteId, $catalogoTransportesMap ?? ($catalogoTransportesOptions ?? []), '')
                    : '';
            }

            $tiempoTxt = null;
            if (!empty($alumTransportes) && !empty($alumTransportes->tiempoRecorridoTransporte->rango_tiempo ?? null)) {
                $tiempoTxt = $alumTransportes->tiempoRecorridoTransporte->rango_tiempo;
            } else {
                if ($tiempoId !== null) {
                    $mapTiempo =
                        (isset($tiempoRecorridoTransporteMap) && is_array($tiempoRecorridoTransporteMap)) ? $tiempoRecorridoTransporteMap
                        : ((isset($tiempoRecorridoTransporteOptions) && is_array($tiempoRecorridoTransporteOptions)) ? $tiempoRecorridoTransporteOptions
                            : ((isset($tiempoRecorridoOptions) && is_array($tiempoRecorridoOptions)) ? $tiempoRecorridoOptions : []));

                    if (empty($mapTiempo)) {
                        $mapTiempo = TiempoRecorridoTransporte::dropdownOptions();
                    }

                    $tiempoTxt = $mapTiempo[(int)$tiempoId] ?? null;
                }
            }

            $transporteOtro = trim((string)F::firstProp($alumTransportes ?? null, ['otro_especificar', 'otro', 'transporte_otro'])) ?: null;

            // Determinamos si hay registro útil
            $hayTransporte = (trim((string)$transporteTxt) !== '') || !empty($transporteOtro) || !empty($tiempoTxt);
            ?>

            <?php if ($hayTransporte): ?>
                <table>
                    <tr>
                        <td class="label">Medio de transporte</td>
                        <td class="value">
                            <?= F::fmt($transporteTxt ?: null) ?>
                            <?php if (!empty($transporteOtro)): ?>
                                <br><span class="muted">Otro:</span> <?= F::fmt($transporteOtro) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Tiempo de recorrido</td>
                        <td class="value"><?= F::fmt($tiempoTxt) ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <table>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No cuenta con información de transporte registrada.</span></td>
                    </tr>
                </table>
            <?php endif; ?>
        </div>


        <!-- ========================= -->
        <!-- X. SALUD -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("X. Información de salud") ?>

            <?php
            $medFreId = F::firstProp($alumAsisteMedico ?? null, ['frecuencia_tiempo_id', 'frecuencia_id', 'catalogo_frecuencia_id', 'frecuencia_veces_id']);
            $denFreId = F::firstProp($alumAsisteDentista ?? null, ['frecuencia_tiempo_id', 'frecuencia_id', 'catalogo_frecuencia_id', 'frecuencia_veces_id']);

            $medBool = F::firstProp($alumAsisteMedico ?? null, ['asiste_medico', 'asiste', 'tiene']);
            $denBool = F::firstProp($alumAsisteDentista ?? null, ['asiste_dentista', 'asiste', 'tiene']);

            $medFreTxt = $medFreId !== null ? F::map($medFreId, $frecuenciasTiempoMap ?? []) : null;
            $denFreTxt = $denFreId !== null ? F::map($denFreId, $frecuenciasTiempoMap ?? []) : null;

            // ✅ IMPORTANTE: usar arreglos "válidos" (ya filtrados en Facade/Service)
            // Estos deben llegar a la vista: $problemasSaludValidos, $alergiasValidas, $tratamientosValidos
            $problemasSaludValidos = $problemasSaludValidos ?? [];
            $alergiasValidas       = $alergiasValidas ?? [];
            $tratamientosValidos   = $tratamientosValidos ?? [];

            $tieneProblemasSalud = !empty($problemasSaludValidos);
            $tieneCronicas       = !empty($enfermedadesCronicasSeleccionadas);
            $tieneAlergias       = !empty($alergiasValidas);
            $tieneTratamientos   = !empty($tratamientosValidos);

            $usaAnteojos = F::firstProp($alumUsoAnteojos ?? null, ['usa_anteojos', 'utiliza_anteojos', 'tiene_anteojos', 'usa_lentes', 'uso_anteojos']);
            if ($usaAnteojos === null) $usaAnteojos = !empty($usoAnteojosSeleccionados) ? 1 : 0;
            ?>

            <h3>Chequeos básicos</h3>
            <table>
                <tr>
                    <td class="label">¿Con qué frecuencia acudes al médico?</td>
                    <td class="value"><?= $medFreTxt ? F::fmt($medFreTxt) : F::bool($medBool) ?></td>
                </tr>
                <tr>
                    <td class="label">¿Con qué frecuencia acudes al dentista?</td>
                    <td class="value"><?= $denFreTxt ? F::fmt($denFreTxt) : F::bool($denBool) ?></td>
                </tr>
            </table>

            <?= hrBreak() ?>

            <h3>Problemas de salud</h3>
            <table>
                <tr>
                    <td class="label">¿Has tenido problemas de salud importantes?</td>
                    <td class="value"><?= F::bool($tieneProblemasSalud ? 1 : 0) ?></td>
                </tr>
            </table>

            <?php if (!empty($problemasSaludValidos)): ?>
                <table>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Problema</th>
                        <th style="width:120px;">Gravedad</th>
                    </tr>
                    <?php foreach ($problemasSaludValidos as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <?= F::map($p->catalogo_problemas_salud_id ?? null, $catalogoProblemasSaludMap ?? []) ?>
                                <?php $otroProblema = trim((string)($p->otro_especificar ?? '')); ?>
                                <?php if ($otroProblema !== ''): ?>
                                    <br><span class="muted">Otro:</span> <?= F::fmt($otroProblema) ?>
                                <?php endif; ?>
                            </td>
                            <td><?= F::map($p->tipo_gravedad_id ?? null, $tipoGravedadMap ?? []) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="muted">Sin registros.</p>
            <?php endif; ?>

            <?= hrBreak() ?>

            <h3>Enfermedades crónicas</h3>
            <table>
                <tr>
                    <td class="label">¿Tienes alguna enfermedad crónica diagnosticada actualmente?</td>
                    <td class="value"><?= F::bool($tieneCronicas ? 1 : 0) ?></td>
                </tr>
            </table>

            <?php if (!empty($enfermedadesCronicasSeleccionadas)): ?>
                <ul>
                    <?php foreach ($enfermedadesCronicasSeleccionadas as $catalogoId => $row): ?>
                        <li>
                            <?= F::map($catalogoId, $catalogoEnfermCronicasMap ?? []) ?>
                            <?php if (!empty($row->otro_especificar)): ?>
                                <span class="muted"> (Otro: <?= F::fmt($row->otro_especificar) ?>)</span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="muted">No registró enfermedades crónicas.</p>
            <?php endif; ?>

            <?= hrBreak() ?>

            <h3>Alergias</h3>
            <table>
                <tr>
                    <td class="label">¿Te han diagnosticado alergias?</td>
                    <td class="value"><?= F::bool($tieneAlergias ? 1 : 0) ?></td>
                </tr>
            </table>

            <?php if (!empty($alergiasValidas)): ?>
                <table>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Alergia</th>
                        <th style="width:120px;">Gravedad</th>
                        <th>Reacciones</th>
                    </tr>
                    <?php foreach ($alergiasValidas as $i => $a): ?>
                        <?php
                        $catId   = (int)($a->catalogo_alergias_id ?? 0);
                        $reacIds = $reaccionesAlergiasSeleccionadas[$catId] ?? [];
                        $otroAlergia = trim((string)($a->otro_especificar ?? ''));
                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <?= F::map($a->catalogo_alergias_id ?? null, $catalogoAlergiasMap ?? []) ?>
                                <?php if ($otroAlergia !== ''): ?>
                                    <br><span class="muted">Otro:</span> <?= F::fmt($otroAlergia) ?>
                                <?php endif; ?>
                            </td>
                            <td><?= F::map($a->tipo_gravedad_id ?? null, $tipoGravedadMap ?? []) ?></td>
                            <td><?= F::listByIds($reacIds, $catalogoReaccionesAlergicasMap ?? []) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="muted">No registró alergias.</p>
            <?php endif; ?>

            <?= hrBreak() ?>

            <h3>Tratamientos</h3>
            <table>
                <tr>
                    <td class="label">¿Estás en algún tratamiento o terapia actualmente?</td>
                    <td class="value"><?= F::bool($tieneTratamientos ? 1 : 0) ?></td>
                </tr>
            </table>

            <?php if (!empty($tratamientosValidos)): ?>
                <table>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Tratamiento</th>
                        <th style="width:140px;">Frecuencia</th>
                        <th style="width:180px;">Rango de fechas</th>
                    </tr>
                    <?php foreach ($tratamientosValidos as $i => $t): ?>
                        <?php
                        $inicio = F::firstProp($t, ['fecha_inicio', 'inicio', 'desde', 'rango_inicio', 'fecha_desde']);
                        $fin    = F::firstProp($t, ['fecha_fin', 'fin', 'hasta', 'rango_fin', 'fecha_hasta']);
                        $otroTratamiento = trim((string)($t->otro_especificar ?? ''));

                        $rango = trim(
                            ($inicio ? F::dateFmt($inicio, 'd/m/Y') : '') .
                                ($fin ? ' - ' . F::dateFmt($fin, 'd/m/Y') : '')
                        );

                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <?= F::map($t->catalogo_tratamientos_id ?? null, $catalogoTratamientosMap ?? []) ?>
                                <?php if ($otroTratamiento !== ''): ?>
                                    <br><span class="muted">Otro:</span> <?= F::fmt($otroTratamiento) ?>
                                <?php endif; ?>
                            </td>
                            <td><?= F::map($t->frecuencia_tiempo_id ?? null, $frecuenciasTiempoMap ?? []) ?></td>
                            <td><?= F::fmt($rango ?: null) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="muted">Sin tratamientos registrados.</p>
            <?php endif; ?>

            <?= hrBreak() ?>

            <h3>Servicios de salud</h3>

            <?php
            $serviciosIds = $serviciosSaludSeleccionados ?? [];
            $tieneCobertura = !empty($serviciosIds);
            ?>

            <table>
                <tr>
                    <td class="label">¿Cuentas con algún servicio o cobertura de salud?</td>
                    <td class="value"><?= F::bool($tieneCobertura ? 1 : 0) ?></td>
                </tr>

                <?php if ($tieneCobertura): ?>
                    <tr>
                        <td class="label">Cobertura / servicios</td>
                        <td class="value">
                            <?= F::listByIds($serviciosIds, $catalogoServiciosSaludMap ?? []) ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td class="label">Cobertura / servicios</td>
                        <td class="value"><span class="muted">No cuenta con cobertura.</span></td>
                    </tr>
                <?php endif; ?>
            </table>


            <?= hrBreak() ?>

            <h3>Uso de anteojos</h3>
            <table>
                <tr>
                    <td class="label">¿Utilizas anteojos o lentes de contacto?</td>
                    <td class="value"><?= F::bool($usaAnteojos) ?></td>
                </tr>
                <?php if ((int)$usaAnteojos === 1): ?>
                    <tr>
                        <td class="label">Tipo de uso</td>
                        <td class="value">
                            <?php
                            $usoTxt = F::listByIds($usoAnteojosSeleccionados ?? [], $catalogoUsoAnteojosMap ?? []);
                            ?>
                            <?= $usoTxt !== 'No registrado' ? $usoTxt : '<span class="muted">Sin tipo de uso registrado.</span>' ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No utiliza anteojos.</span></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>


        <div class="page-break"></div>

        <!-- ========================= -->
        <!-- XI. ALIMENTACION Y CONSUMO -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("XI. Alimentación y consumo") ?>

            <h3>Lugares donde sueles comer</h3>
            <table>
                <tr>
                    <td class="label">Lugares</td>
                    <td class="value">
                        <?= F::listByIds($lugaresComerSeleccionados ?? [], $catalogoLugaresComerMap ?? []) ?>
                        <?php if (!empty($lugaresComerOtroMap)): ?>
                            <?php foreach ($lugaresComerOtroMap as $cid => $texto): ?>
                                <br><span class="muted"><?= F::map($cid, $catalogoLugaresComerMap ?? []) ?>:</span> <?= F::fmt($texto) ?>
                            <?php endforeach; ?>
                        <?php elseif (!empty($lugarComerOtro)): ?>
                            <br><span>Otro:</span> <?= F::fmt($lugarComerOtro) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <?= hrBreak() ?>

            <h3>Frecuencia de consumo de alimentos</h3>
            <?php if (!empty($consumoAlimentos)): ?>
                <table>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Grupo de alimento</th>
                        <th style="width:190px;">Frecuencia semanal (veces)</th>
                    </tr>
                    <?php foreach ($consumoAlimentos as $i => $c): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= F::map($c->catalogo_alimentos_id ?? null, $catalogoAlimentosMap ?? []) ?></td>
                            <td><?= F::map($c->frecuencia_veces_id ?? null, $frecuenciasVecesMap ?? []) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="muted">Sin registros de consumo de alimentos.</p>
            <?php endif; ?>

        </div>

        <!-- ========================= -->
        <!-- XII. ACTIVIDAD FISICA Y DEPORTE -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("XII. Actividad física y deporte") ?>

            <?php
            // Deportes
            $practicaDeporte = F::firstProp($alumActividadFisica ?? null, ['practica_deporte', 'tiene_deporte', 'deporte', 'realiza_deporte']);
            if ($practicaDeporte === null) $practicaDeporte = !empty($deportesSeleccionados) ? 1 : 0;

            // Ejercicio
            $haceEjercicio = F::firstProp($alumEjercicioFisico ?? null, ['hace_ejercicio', 'realiza_ejercicio', 'ejercicio', 'actividad_fisica']);
            if ($haceEjercicio === null) $haceEjercicio = !empty($ejercicioFisicos) ? 1 : 0;
            ?>

            <h3>Deportes que practicas</h3>
            <table>
                <tr>
                    <td class="label">¿Practicas algún deporte?</td>
                    <td class="value"><?= F::bool($practicaDeporte) ?></td>
                </tr>
                <?php if ((int)$practicaDeporte === 1): ?>
                    <tr>
                        <td class="label">Deportes</td>
                        <td class="value">
                            <?php
                            $depTxt = F::listByIds($deportesSeleccionados ?? [], $catalogoDeportesMap ?? []);
                            ?>
                            <?= $depTxt !== 'No registrado' ? $depTxt : '<span class="muted">Sin deportes registrados.</span>' ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No practica deportes.</span></td>
                    </tr>
                <?php endif; ?>
            </table>

            <?= hrBreak() ?>

            <h3>Ejercicio físico</h3>
            <table>
                <tr>
                    <td class="label">¿Haces ejercicio físico?</td>
                    <td class="value"><?= F::bool($haceEjercicio) ?></td>
                </tr>
            </table>

            <?php if (!empty($ejercicioFisicos)): ?>
                <table>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Actividad</th>
                        <th style="width:210px;">Frecuencia semanal</th>
                    </tr>
                    <?php foreach ($ejercicioFisicos as $i => $e): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= F::map($e->catalogo_actividad_ejercicio_id ?? null, $catalogoActividadesEjercicioMap ?? []) ?></td>
                            <td><?= F::map($e->frecuencia_veces_semana_id ?? null, $frecuenciasVecesSemanaMap ?? []) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="muted">Sin registros de ejercicio físico.</p>
            <?php endif; ?>
        </div>

        <!-- ========================= -->
        <!-- XIII. HABITOS: TABACO, ALCOHOL Y ADICCIONES -->
        <!-- ========================= -->
        <div class="box section-card page-block">
            <?= boxTitle("XIII. Hábitos (tabaco, alcohol y adicciones)") ?>

            <?php
    // Usa el modelo real si existe; si tu facade lo manda con otro nombre, aquí lo soportas.
            /** @var \common\models\AlumHabitosConsumo|null $habitosModel */
            $habitosModel = $alumHabitosConsumo ?? ($alumHabitos ?? null);

            // Tabaco
            $fuma = $habitosModel ? ($habitosModel->fumas ?? null) : null;

            // Cigarros por día (preferimos relación, si no, mostramos el id)
            $cigarrosDiaTxt = null;
            if ($habitosModel && !empty($habitosModel->catalogoCigarrosDia) && !empty($habitosModel->catalogoCigarrosDia->nombre)) {
                $cigarrosDiaTxt = $habitosModel->catalogoCigarrosDia->nombre;
            } else {
                $cigarrosDiaTxt = $habitosModel ? F::fmt($habitosModel->catalogo_cigarros_dia_id ?? null) : null;
            }

            // Alcohol
            $tomaAlcohol = $habitosModel ? ($habitosModel->tomas_alcohol ?? null) : null;

            // Frecuencia alcohol (id => nombre)
            $alcoholFreTxt = null;
            if ($habitosModel) {
                // ✅ primer intento: relación
                if (!empty($habitosModel->frecuenciaVecesSemana) && !empty($habitosModel->frecuenciaVecesSemana->nombre)) {
                    $alcoholFreTxt = $habitosModel->frecuenciaVecesSemana->nombre;
                } else {
                    // ✅ fallback: map si lo mandas desde el service
                    $alcoholFreId = $habitosModel->frecuencia_veces_semana_id ?? null;

                    $mapAlcoholFre = $frecuenciaVecesSemanaMap
                        ?? $frecuenciasVecesSemanaMap
                        ?? $frecuenciasVecesSemanaOptions
                        ?? [];

                    if ($alcoholFreId !== null && is_array($mapAlcoholFre) && !empty($mapAlcoholFre)) {
                        $alcoholFreTxt = $mapAlcoholFre[(int)$alcoholFreId] ?? null;
                    }
                }
            }

            // Adicciones
            $tieneAdicciones = $habitosModel ? ($habitosModel->tienes_adicciones ?? null) : null;
            $adiccionDetalle = $habitosModel ? trim((string)($habitosModel->especificiar_adiccion ?? '')) : '';

            $adiccionDetalleVista = 'No tiene adicciones.';
            if ((int)$tieneAdicciones === 1) {
                $adiccionDetalleVista = $adiccionDetalle !== '' ? $adiccionDetalle : 'Sin detalle registrado.';
            }
            ?>

            <h3>Consumo de tabaco y alcohol</h3>
            <table>
                <tr>
                    <td class="label">Fumas</td>
                    <td class="value"><?= F::bool($fuma) ?></td>
                </tr>
                <?php if ((int)$fuma === 1): ?>
                    <tr>
                        <td class="label">Si fumas, ¿cuántos cigarros por día?</td>
                        <td class="value"><?= F::fmt($cigarrosDiaTxt) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td class="label">Consumes alcohol</td>
                    <td class="value"><?= F::bool($tomaAlcohol) ?></td>
                </tr>
                <?php if ((int)$tomaAlcohol === 1): ?>
                    <tr>
                        <td class="label">Frecuencia semanal de alcohol</td>
                        <td class="value"><?= F::fmt($alcoholFreTxt) ?></td>
                    </tr>
                <?php endif; ?>
            </table>

            <?= hrBreak() ?>

            <h3>Otras adicciones</h3>
            <table>
                <tr>
                    <td class="label">Tienes adicciones</td>
                    <td class="value"><?= F::bool($tieneAdicciones) ?></td>
                </tr>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value">
                        <?php if ((int)$tieneAdicciones === 1): ?>
                            <?= F::fmt($adiccionDetalleVista) ?>
                        <?php else: ?>
                            <span class="muted"><?= F::fmt($adiccionDetalleVista) ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

        </div>

        <div class="page-break"></div>

        <!-- ========================= -->
        <!-- XIV. CONEXIÓN Y USO DE INTERNET -->
        <!-- ========================= -->
        <div class="box">
            <?= boxTitle("XIV. Conexión y uso de internet") ?>

            <?php
            // ✅ Evita warning de Intelephense: siempre objeto
            $recreacionModel = $alumRecreacionTiempo ?? (object)[];

            // ✅ Campos REALES del modelo AlumRecreacionTiempo
            $tieneAccesoInternet = $recreacionModel->tienes_acceso_internet ?? null;
            $sabeUsarInternet    = $recreacionModel->sabes_usar_internet ?? null;

            $lugarAccesoId  = $recreacionModel->catalogo_lugares_acceso_principal_id ?? null;

            $lugarAccesoTxt = $lugarAccesoId !== null ? F::map($lugarAccesoId, $catalogoLugaresAccesoMap ?? []) : null;
            if (!$lugarAccesoTxt && !empty($recreacionModel->catalogoLugaresAccesoPrincipal->nombre ?? null)) {
                $lugarAccesoTxt = $recreacionModel->catalogoLugaresAccesoPrincipal->nombre;
            }

            // Usos: si viene como array ya, úsalo; si no, intenta relación
            $usosIds = $usosInternetSeleccionados ?? [];
            if (empty($usosIds) && !empty($recreacionModel->usosInternets ?? null)) {
                foreach ($recreacionModel->usosInternets as $ui) {
                    if (isset($ui->catalogo_usos_internet_id)) $usosIds[] = (int)$ui->catalogo_usos_internet_id;
                }
            }
            ?>

            <h3>Conectividad</h3>
            <table>
                <tr>
                    <td class="label">Tienes acceso a internet</td>
                    <td class="value"><?= F::bool($tieneAccesoInternet) ?></td>
                </tr>
                <?php if ((int)$tieneAccesoInternet === 1): ?>
                    <tr>
                        <td class="label">Punto de acceso habitual</td>
                        <td class="value"><?= F::fmt($lugarAccesoTxt) ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No cuenta con acceso a internet.</span></td>
                    </tr>
                <?php endif; ?>
            </table>

            <?= hrBreak() ?>

            <h3>Usos principales</h3>
            <table>
                <tr>
                    <td class="label">Sabes usar internet</td>
                    <td class="value"><?= F::bool($sabeUsarInternet) ?></td>
                </tr>
                <?php if ((int)$sabeUsarInternet === 1): ?>
                    <tr>
                        <td class="label">¿Para qué usas internet?</td>
                        <td class="value">
                            <?php
                            $usoTxt = F::listByIds($usosIds, $catalogoUsosInternetMap ?? []);
                            ?>
                            <?= $usoTxt !== 'No registrado' ? $usoTxt : '<span class="muted">Sin usos registrados.</span>' ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No registra usos de internet.</span></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <!-- ========================= -->
        <!-- XV. ORGANIZACIONES Y PARTICIPACIÓN -->
        <!-- ========================= -->
        <div class="box">
            <?= boxTitle("XV. Organizaciones y participación") ?>

            <?php
            $participaOrg = F::firstProp($alumOrganizaciones ?? null, [
                'participa',
                'participa_organizacion',
                'tiene_organizacion',
                'pertenece_organizacion'
            ]);
            if ($participaOrg === null) {
                $participaOrg = !empty($organizacionesSeleccionadas) ? 1 : 0;
            }

            // ✅ Aquí está la clave: convertir IDs a NOMBRES
            $orgTxt = 'No registrado';
            if (!empty($organizacionesSeleccionadas)) {
                $map = $catalogoOrganizacionesMap ?? [];
                if (is_array($map) && !empty($map)) {
                    $orgTxt = F::listByIds($organizacionesSeleccionadas, $map);
                } else {
                    // fallback si por algo no llega el map
                    $orgTxt = implode(', ', array_map('strval', $organizacionesSeleccionadas));
                }
            }

            $orgOtro = F::firstProp($alumOrganizaciones ?? null, [
                'otro_especificar',
                'organizacion_otro',
                'otro'
            ]);
            ?>

            <table>
                <tr>
                    <td class="label">Participas en alguna organización</td>
                    <td class="value"><?= F::bool($participaOrg) ?></td>
                </tr>
                <?php if ((int)$participaOrg === 1): ?>
                    <tr>
                        <td class="label">Tus organizaciones</td>
                        <td class="value">
                            <?= F::fmt($orgTxt) ?>
                            <?php if (!empty($orgOtro)): ?>
                                <br><span class="muted">Otro:</span> <?= F::fmt($orgOtro) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td class="label">Detalle</td>
                        <td class="value"><span class="muted">No participa en organizaciones.</span></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>


    </div>

</body>

</html>