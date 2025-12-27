<?php

use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var common\models\LugaresNacimiento $lugaresNacimiento */
/* @var common\models\DomiciliosActuales $domiciliosActuales */

$this->title = 'Crear Expediente';
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expediente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'perfil' => $perfil,
        'alumno' => $alumno,
        'datosPersonales' => $datosPersonales,
        'lugaresNacimiento' => $lugaresNacimiento,
        'domiciliosActuales' => $domiciliosActuales,
        'datosGenerales' => $datosGenerales,
        'alumDatosFamiliares' => $alumDatosFamiliares,
        'alumBecas' => $alumBecas,
        'alumInfoHijos' => $alumInfoHijos,
        'alumDependeEconomicamente' => $alumDependeEconomicamente,
        'alumDependenEconomica' => $alumDependenEconomica,
        'dependientes' => $dependientes ?? [],
        'dependientesSeleccionados' => $dependientesSeleccionados ?? [],
        'dependientesOtro' => $dependientesOtro ?? null,
        'edadesHijos' => $edadesHijos ?? [],
        'alumTrabajo' => $alumTrabajo,
        'alumVivienda' => $alumVivienda,
        'catalogoDependenciasOptions' => $catalogoDependenciasOptions,
        'otroCatalogoDependenciaId' => $otroCatalogoDependenciaId,
        'tiposViviendasMap' => $tiposViviendasMap,
        'tipoViviendaOtroId' => $tipoViviendaOtroId,
        'catalogoBienesOptions' => $catalogoBienesOptions,
        'catalogoBienOtroId' => $catalogoBienOtroId,
        'bienesSeleccionados' => $bienesSeleccionados ?? [],
        'bienesOtro' => $bienesOtro ?? null,
        'catalogoServiciosViviendaOptions' => $catalogoServiciosViviendaOptions,
        'catalogoServicioOtroId' => $catalogoServicioOtroId,
        'serviciosSeleccionados' => $serviciosSeleccionados ?? [],
        'serviciosOtro' => $serviciosOtro ?? null,
        'catalogoBienesPersonalesOptions' => $catalogoBienesPersonalesOptions,
        'bienesPersonalesSeleccionados' => $bienesPersonalesSeleccionados ?? [],
        'alumTransportes' => $alumTransportes,
        'catalogoTransportesMap' => $catalogoTransportesMap,
        'tiemposRecorridoMap' => $tiemposRecorridoMap,
        'alumEstadoSalud' => $alumEstadoSalud ?? null,
        'alumEnfermedadesCronicas' => $alumEnfermedadesCronicas ?? null,
        'alumAlergia' => $alumAlergia ?? null,
        'alumAsisteMedico' => $alumAsisteMedico ?? null,
        'alumAsisteDentista' => $alumAsisteDentista ?? null,
        'enfermedadesCronicas' => $enfermedadesCronicas ?? [],
        'alergias' => $alergias ?? [],
        'problemasSalud' => $problemasSalud ?? [],
        'catalogoEnfermCronicasMap' => $catalogoEnfermCronicasMap ?? [],
        'catalogoLugaresComerMap' => $catalogoLugaresComerMap ?? [],
        'catalogoLugarComerOtroId' => $catalogoLugarComerOtroId ?? null,
        'lugaresComerSeleccionados' => $lugaresComerSeleccionados ?? [],
        'lugarComerOtro' => $lugarComerOtro ?? null,
        'lugaresComerOtroMap' => $lugaresComerOtroMap ?? [],
        'catalogoAlimentosMap' => $catalogoAlimentosMap ?? [],
        'frecuenciasVecesMap' => $frecuenciasVecesMap ?? [],
        'consumoAlimentos' => $consumoAlimentos ?? [],
        'catalogoProblemasSaludMap' => $catalogoProblemasSaludMap ?? [],
        'catalogoAlergiasMap' => $catalogoAlergiasMap ?? [],
        'catalogoReaccionesAlergicasMap' => $catalogoReaccionesAlergicasMap ?? [],
        'alumServiciosSalud' => $alumServiciosSalud ?? null,
        'serviciosSaludSeleccionados' => $serviciosSaludSeleccionados ?? [],
        'enfermedadesCronicasSeleccionadas' => $enfermedadesCronicasSeleccionadas ?? [],
        'reaccionesAlergiasSeleccionadas' => $reaccionesAlergiasSeleccionadas ?? [],
        'catalogoServiciosSaludMap' => $catalogoServiciosSaludMap ?? [],
        'alumUsoAnteojos' => $alumUsoAnteojos ?? null,
        'usoAnteojosSeleccionados' => $usoAnteojosSeleccionados ?? [],
        'catalogoUsoAnteojosMap' => $catalogoUsoAnteojosMap ?? [],
        'frecuenciasTiempoMap' => $frecuenciasTiempoMap ?? [],
        'tipoGravedadMap' => $tipoGravedadMap ?? [],
        'otroCatalogoProblemaId' => $otroCatalogoProblemaId ?? null,
        'alumTratamientos' => $alumTratamientos ?? null,
        'tratamientos' => $tratamientos ?? [],
        'catalogoTratamientosMap' => $catalogoTratamientosMap ?? [],
    ]) ?>

</div>
