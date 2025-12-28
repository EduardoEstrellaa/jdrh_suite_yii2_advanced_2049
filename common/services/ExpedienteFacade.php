<?php

namespace common\services;

use DomainException;
use Yii;
use common\models\AlumDependenEconomica;
use common\models\AlumInfoHijos;
use common\models\AlumBienesPersonales;
use common\models\AlumVivienda;
use common\models\AlumEstadoSalud;
use common\models\AlumEnfermedadesCronicas;
use common\models\AlumAlergia;
use common\models\AlumAsisteMedico;
use common\models\AlumAsisteDentista;
use common\models\AlumServiciosSalud;
use common\models\AlumUsoAnteojos;
use common\models\AlumTratamientos;
use common\models\AlumRecreacionTiempo;
use common\models\AlumConsumoAlimentos;
use common\models\AlumLugaresComer;
use common\models\AlumOrganizacion;
use common\models\Alergias;
use common\models\CatalogoBienesPersonales;
use common\models\CatalogoBienesVivienda;
use common\models\CatalogoDependenciasEconomicas;
use common\models\CatalogoEnfermCronicas;
use common\models\CatalogoAlergias;
use common\models\CatalogoProblemasSalud;
use common\models\CatalogoReaccionesAlergicas;
use common\models\CatalogoServiciosSalud;
use common\models\CatalogoServiciosVivienda;
use common\models\CatalogoTratamientos;
use common\models\CatalogoUsoAnteojos;
use common\models\CatalogoLugaresAccesoPrincipal;
use common\models\CatalogoUsosInternet;
use common\models\CatalogoOrganizaciones;
use common\models\CatalogoCigarrosDia;
use common\models\CatalogoTransportes;
use common\models\CatalogoLugaresComer;
use common\models\CatalogoAlimentos;
use common\models\CatalogoActividadEjercicio;
use common\models\CatalogoDeportes;
use common\models\Dependientes;
use common\models\EdadesHijos;
use common\models\FrecuenciaVeces;
use common\models\FrecuenciaVecesSemana;
use common\models\FrecuenciaTiempo;
use common\models\ServiciosSalud;
use common\models\UsoAnteojos;
use common\models\TiempoRecorridoTransporte;
use common\models\TipoGravedad;
use common\models\TiposViviendas;
use common\models\ViviendaBienes;
use common\models\ViviendaServicios;
use common\models\VariasReaccionesAlergicas;
use common\models\Tratamientos;
use common\models\EnfermedadesCronicas;
use common\models\ProblemasSalud;
use common\models\AlumDeportes;
use common\models\AlumEjercicio;
use common\models\Deportes;
use common\models\Organizaciones;
use common\models\EjercicioFisico;
use common\models\UsosInternet;
use common\services\support\OperationResult;

class ExpedienteFacade
{
    /**
     * Datos iniciales para vista de creación.
     */
    public function getCreateData($perfil, $alumno)
    {
        $models = ExpedienteService::getModelsForCreate($perfil, $alumno);

        return array_merge(
            $models,
            $this->getDependientesDefaults(),
            $this->getViviendaDefaults(),
            $this->getAlimentacionDefaults($alumno->id),
            $this->getActividadFisicaDefaults(),
            $this->getRecreacionDefaults(),
            $this->getOrganizacionDefaults(),
            $this->getSaludDefaults(),
            $this->getTratamientosDefaults(),
            $this->getCatalogosData()
        );
    }

    /**
     * Datos completos para vistas de actualización/consulta.
     */
    public function getUpdateData($perfilId, $alumnoId)
    {
        $models = ExpedienteService::getModelsForUpdate($perfilId, $alumnoId);
        $dependientesData = $this->buildDependientesData($models['alumDependenEconomica']);
        $edadesHijos = $this->getEdadesHijos($models['alumInfoHijos']);
        $bienesData = $this->buildViviendaBienesData($models['alumVivienda']);
        $serviciosData = $this->buildViviendaServiciosData($models['alumVivienda']);
        $bienesPersonalesData = $this->buildBienesPersonalesData($alumnoId);
        $problemasSaludData = $this->buildProblemasSaludData($models['alumEstadoSalud'] ?? null);
        $serviciosSaludData = $this->buildServiciosSaludData($models['alumServiciosSalud'] ?? null);
        $usoAnteojosData = $this->buildUsoAnteojosData($models['alumUsoAnteojos'] ?? null);
        $tratamientosData = $this->buildTratamientosData($models['alumTratamientos'] ?? null);
        $enfermedadesCronicasData = $this->buildEnfermedadesCronicasData($models['alumEnfermedadesCronicas'] ?? null);
        $alergiasData = $this->buildAlergiasData($models['alumAlergia'] ?? null);
        $lugaresComerData = $this->buildLugaresComerData($alumnoId);
        $consumoAlimentosData = $this->buildConsumoAlimentosData($alumnoId);
        $deportesData = $this->buildDeportesData($models['alumDeportes'] ?? null);
        $ejercicioData = $this->buildEjercicioFisicoData($models['alumEjercicio'] ?? null);
        $recreacionData = $this->buildRecreacionData($models['alumRecreacionTiempo'] ?? null);
        $organizacionesData = $this->buildOrganizacionesData($models['alumOrganizacion'] ?? null);

        return array_merge(
            $models,
            $dependientesData,
            $bienesData,
            $serviciosData,
            $bienesPersonalesData,
            $problemasSaludData,
            $serviciosSaludData,
            $usoAnteojosData,
            $tratamientosData,
            $enfermedadesCronicasData,
            $alergiasData,
            $lugaresComerData,
            $consumoAlimentosData,
            $deportesData,
            $ejercicioData,
            $recreacionData,
            $organizacionesData,
            ['alumAsisteMedico' => $models['alumAsisteMedico']],
            ['alumAsisteDentista' => $models['alumAsisteDentista']],
            ['edadesHijos' => $edadesHijos],
            $this->getCatalogosData()
        );
    }

    /**
     * Crea expediente manejando errores de dominio y registrando bitácora.
     */
    public function create($perfil, $alumno, array $post)
    {
        try {
            ExpedienteService::crearExpediente($perfil, $alumno, $post);
            return OperationResult::ok('Expediente guardado correctamente.');
        } catch (DomainException $e) {
            Yii::warning($e->getMessage(), __METHOD__);
            return OperationResult::fail($e->getMessage());
        } catch (\Throwable $e) {
            Yii::error($e->getMessage(), __METHOD__);
            return OperationResult::fail('Error inesperado al guardar el expediente.');
        }
    }

    /**
     * Actualiza expediente existente manejando errores de dominio y registro.
     */
    public function update($perfilId, $alumnoId, array $post)
    {
        try {
            $saved = ExpedienteService::actualizarExpediente($perfilId, $alumnoId, $post);
            if ($saved) {
                return OperationResult::ok('Expediente actualizado correctamente.');
            }
            return OperationResult::fail('Error al guardar el expediente. Verifica los datos.');
        } catch (DomainException $e) {
            Yii::warning($e->getMessage(), __METHOD__);
            return OperationResult::fail($e->getMessage());
        } catch (\Throwable $e) {
            Yii::error($e->getMessage(), __METHOD__);
            return OperationResult::fail('Error al guardar el expediente.');
        }
    }

    private function buildDependientesData(?AlumDependenEconomica $alumDependenEconomica = null): array
    {
        if ($alumDependenEconomica === null || $alumDependenEconomica->isNewRecord) {
            return $this->getDependientesDefaults();
        }

        $dependientes = Dependientes::findAll([
            'alum_dependen_economica_id' => $alumDependenEconomica->id,
        ]);

        $seleccionados = [];
        $dependientesOtro = null;
        $otroId = CatalogoDependenciasEconomicas::getOtroId();

        foreach ($dependientes as $dep) {
            $depId = (int)$dep->catalogo_dependencias_economicas_id;
            $seleccionados[] = $depId;
            if ($otroId !== null && $depId === (int)$otroId) {
                $dependientesOtro = $dep->otro_especificar;
            }
        }

        return [
            'dependientes' => $dependientes,
            'dependientesSeleccionados' => $seleccionados,
            'dependientesOtro' => $dependientesOtro,
        ];
    }

    private function getDependientesDefaults(): array
    {
        return [
            'dependientes' => [],
            'dependientesSeleccionados' => [],
            'dependientesOtro' => null,
        ];
    }

    private function getEdadesHijos(?AlumInfoHijos $alumInfoHijos = null): array
    {
        if ($alumInfoHijos === null || $alumInfoHijos->isNewRecord) {
            return [];
        }

        return EdadesHijos::findAll([
            'alum_info_hijos_id' => $alumInfoHijos->id,
        ]);
    }

    private function buildProblemasSaludData(?AlumEstadoSalud $alumEstadoSalud = null): array
    {
        if ($alumEstadoSalud === null || $alumEstadoSalud->isNewRecord) {
            return ['problemasSalud' => [new ProblemasSalud()]];
        }

        $problemas = ProblemasSalud::find()
            ->where(['alum_estado_salud_id' => $alumEstadoSalud->id])
            ->all();

        if (empty($problemas)) {
            $problemas = [new ProblemasSalud()];
        }

        return [
            'problemasSalud' => $problemas,
        ];
    }

    private function buildServiciosSaludData(?AlumServiciosSalud $alumServiciosSalud = null): array
    {
        if ($alumServiciosSalud === null || $alumServiciosSalud->isNewRecord) {
            return ['serviciosSaludSeleccionados' => []];
        }

        $ids = ServiciosSalud::find()
            ->select('catalogo_servicios_salud_id')
            ->where(['alum_servicios_salud_id' => $alumServiciosSalud->id])
            ->column();

        return [
            'serviciosSaludSeleccionados' => array_map('intval', $ids),
        ];
    }

    private function buildUsoAnteojosData(?AlumUsoAnteojos $alumUsoAnteojos = null): array
    {
        if ($alumUsoAnteojos === null || $alumUsoAnteojos->isNewRecord) {
            return ['usoAnteojosSeleccionados' => []];
        }

        $ids = UsoAnteojos::find()
            ->select('catalogo_uso_anteojos_id')
            ->where(['alum_uso_anteojos_id' => $alumUsoAnteojos->id])
            ->column();

        return [
            'usoAnteojosSeleccionados' => array_map('intval', $ids),
        ];
    }

    private function buildTratamientosData(?AlumTratamientos $alumTratamientos = null): array
    {
        if ($alumTratamientos === null || $alumTratamientos->isNewRecord) {
            return ['tratamientos' => [new Tratamientos()]];
        }

        $tratamientos = Tratamientos::find()
            ->where(['alum_tratamientos_id' => $alumTratamientos->id])
            ->all();

        if (empty($tratamientos)) {
            $tratamientos = [new Tratamientos()];
        }

        return [
            'tratamientos' => $tratamientos,
        ];
    }

    private function buildLugaresComerData(int $alumnoId): array
    {
        $lugares = AlumLugaresComer::findAll(['alumnos_id' => $alumnoId]);
        $seleccionados = [];
        $otroTexto = null;
        $otrosPorId = [];
        $otroId = CatalogoLugaresComer::getOtroId();

        foreach ($lugares as $lugar) {
            $catalogoId = (int)$lugar->catalogo_lugares_comer_id;
            $seleccionados[] = $catalogoId;
            if ($otroId !== null && $catalogoId === $otroId) {
                $otroTexto = $lugar->otro_especificar;
            }
            if ($lugar->otro_especificar !== null && $lugar->otro_especificar !== '') {
                $otrosPorId[$catalogoId] = $lugar->otro_especificar;
            }
        }

        return [
            'lugaresComerSeleccionados' => $seleccionados,
            'lugarComerOtro' => $otroTexto,
            'lugaresComerOtroMap' => $otrosPorId,
        ];
    }

    private function buildConsumoAlimentosData(int $alumnoId): array
    {
        $consumos = AlumConsumoAlimentos::findAll(['alumnos_id' => $alumnoId]);

        if (empty($consumos)) {
            $consumos = [new AlumConsumoAlimentos(['alumnos_id' => $alumnoId])];
        }

        return [
            'consumoAlimentos' => $consumos,
        ];
    }

    private function buildDeportesData(?AlumDeportes $alumDeportes = null): array
    {
        if ($alumDeportes === null || $alumDeportes->isNewRecord) {
            return ['deportesSeleccionados' => []];
        }

        $ids = Deportes::find()
            ->select('catalogo_deportes_id')
            ->where(['alum_deportes_id' => $alumDeportes->id])
            ->column();

        return ['deportesSeleccionados' => array_map('intval', $ids)];
    }

    private function buildEjercicioFisicoData(?AlumEjercicio $alumEjercicio = null): array
    {
        if ($alumEjercicio === null || $alumEjercicio->isNewRecord) {
            return ['ejercicioFisicos' => []];
        }

        $ejercicios = EjercicioFisico::find()
            ->where(['alum_ejercicio_id' => $alumEjercicio->id])
            ->all();

        return ['ejercicioFisicos' => $ejercicios];
    }

    private function buildEnfermedadesCronicasData(?AlumEnfermedadesCronicas $alumEnfermedadesCronicas = null): array
    {
        if ($alumEnfermedadesCronicas === null || $alumEnfermedadesCronicas->isNewRecord) {
            return [
                'alumEnfermedadesCronicas' => $alumEnfermedadesCronicas ?? new AlumEnfermedadesCronicas(),
                'enfermedadesCronicas' => [new EnfermedadesCronicas()],
                'enfermedadesCronicasSeleccionadas' => [],
            ];
        }

        $enfermedades = EnfermedadesCronicas::find()
            ->where(['alum_enfermedades_cronicas_id' => $alumEnfermedadesCronicas->id])
            ->all();

        $seleccionadas = [];
        foreach ($enfermedades as $enfermedad) {
            $seleccionadas[(int)$enfermedad->catalogo_enferm_cronicas_id] = $enfermedad;
        }

        if (empty($enfermedades)) {
            $enfermedades = [new EnfermedadesCronicas()];
        }

        return [
            'alumEnfermedadesCronicas' => $alumEnfermedadesCronicas,
            'enfermedadesCronicas' => $enfermedades,
            'enfermedadesCronicasSeleccionadas' => $seleccionadas,
        ];
    }

    private function buildAlergiasData(?AlumAlergia $alumAlergia = null): array
    {
        if ($alumAlergia === null || $alumAlergia->isNewRecord) {
            return [
                'alergias' => [new Alergias()],
                'reaccionesAlergiasSeleccionadas' => [],
            ];
        }

        $alergias = Alergias::find()
            ->where(['alum_alergia_id' => $alumAlergia->id])
            ->all();

        $reacciones = [];
        foreach ($alergias as $alergia) {
            $catalogoId = (int)$alergia->catalogo_alergias_id;
            $ids = VariasReaccionesAlergicas::find()
                ->select('catalogo_reacciones_alergicas_id')
                ->where(['alergias_id' => $alergia->id])
                ->column();
            $reacciones[$catalogoId] = array_map('intval', $ids);
        }

        if (empty($alergias)) {
            $alergias = [new Alergias()];
        }

        return [
            'alergias' => $alergias,
            'reaccionesAlergiasSeleccionadas' => $reacciones,
        ];
    }

    private function buildViviendaBienesData(?AlumVivienda $alumVivienda = null): array
    {
        if ($alumVivienda === null || $alumVivienda->isNewRecord) {
            return $this->getViviendaDefaults();
        }

        $bienes = ViviendaBienes::findAll([
            'alum_vivienda_id' => $alumVivienda->id,
        ]);

        $seleccionados = [];
        $bienesOtro = null;
        $otroId = CatalogoBienesVivienda::getOtroId();

        foreach ($bienes as $bien) {
            $bienId = (int)$bien->catalogo_bienes_vivienda_id;
            $seleccionados[] = $bienId;

            if ($otroId !== null && $bienId === $otroId) {
                $bienesOtro = $bien->otro_especificar;
            }
        }

        return [
            'bienesSeleccionados' => $seleccionados,
            'bienesOtro' => $bienesOtro,
        ];
    }

    private function buildViviendaServiciosData(?AlumVivienda $alumVivienda = null): array
    {
        if ($alumVivienda === null || $alumVivienda->isNewRecord) {
            return [
                'serviciosSeleccionados' => [],
                'serviciosOtro' => null,
            ];
        }

        $servicios = ViviendaServicios::findAll([
            'alum_vivienda_id' => $alumVivienda->id,
        ]);

        $seleccionados = [];
        $serviciosOtro = null;
        $otroId = CatalogoServiciosVivienda::getOtroId();

        foreach ($servicios as $servicio) {
            $servicioId = (int)$servicio->catalogo_servicios_vivienda_id;
            $seleccionados[] = $servicioId;

            if ($otroId !== null && $servicioId === $otroId) {
                $serviciosOtro = $servicio->otro_especificar;
            }
        }

        return [
            'serviciosSeleccionados' => $seleccionados,
            'serviciosOtro' => $serviciosOtro,
        ];
    }

    private function buildBienesPersonalesData(int $alumnoId): array
    {
        $seleccionados = AlumBienesPersonales::find()
            ->select('catalogo_bienes_personales_id')
            ->where(['alumnos_id' => $alumnoId])
            ->column();

        $seleccionados = array_map('intval', $seleccionados);

        return [
            'bienesPersonalesSeleccionados' => $seleccionados,
        ];
    }

    private function buildRecreacionData(?AlumRecreacionTiempo $alumRecreacionTiempo = null): array
    {
        if ($alumRecreacionTiempo === null || $alumRecreacionTiempo->isNewRecord) {
            return $this->getRecreacionDefaults();
        }

        $ids = UsosInternet::find()
            ->select('catalogo_usos_internet_id')
            ->where(['alum_recreacion_tiempo_id' => $alumRecreacionTiempo->id])
            ->column();

        return [
            'usosInternetSeleccionados' => array_map('intval', $ids),
        ];
    }

    private function buildOrganizacionesData(?AlumOrganizacion $alumOrganizacion = null): array
    {
        if ($alumOrganizacion === null || $alumOrganizacion->isNewRecord) {
            return $this->getOrganizacionDefaults();
        }

        $organizaciones = Organizaciones::find()
            ->where(['alum_organizacion_id' => $alumOrganizacion->id])
            ->all();

        $seleccionadas = [];
        $otros = [];

        foreach ($organizaciones as $organizacion) {
            $catalogoId = (int)$organizacion->catalogo_organizaciones_id;
            $seleccionadas[] = $catalogoId;
            if ($organizacion->otra_organizacion_especificar !== null && $organizacion->otra_organizacion_especificar !== '') {
                $otros[$catalogoId] = $organizacion->otra_organizacion_especificar;
            }
        }

        return [
            'organizacionesSeleccionadas' => array_values(array_unique($seleccionadas)),
            'organizacionesOtroMap' => $otros,
        ];
    }

    private function getViviendaDefaults(): array
    {
        return [
            'bienesSeleccionados' => [],
            'bienesOtro' => null,
        ];
    }

    private function getAlimentacionDefaults(int $alumnoId): array
    {
        return [
            'lugaresComerSeleccionados' => [],
            'lugarComerOtro' => null,
            'lugaresComerOtroMap' => [],
            'consumoAlimentos' => [new AlumConsumoAlimentos(['alumnos_id' => $alumnoId])],
        ];
    }

    private function getActividadFisicaDefaults(): array
    {
        return [
            'deportesSeleccionados' => [],
            'ejercicioFisicos' => [],
        ];
    }

    private function getRecreacionDefaults(): array
    {
        return [
            'usosInternetSeleccionados' => [],
        ];
    }

    private function getOrganizacionDefaults(): array
    {
        return [
            'organizacionesSeleccionadas' => [],
            'organizacionesOtroMap' => [],
        ];
    }

    private function getSaludDefaults(): array
    {
        return [
            'alumEnfermedadesCronicas' => new AlumEnfermedadesCronicas(),
            'enfermedadesCronicas' => [new EnfermedadesCronicas()],
            'enfermedadesCronicasSeleccionadas' => [],
            'alumAlergia' => new AlumAlergia(),
            'alergias' => [new Alergias()],
            'reaccionesAlergiasSeleccionadas' => [],
            'problemasSalud' => [new ProblemasSalud()],
            'serviciosSaludSeleccionados' => [],
            'alumAsisteMedico' => new AlumAsisteMedico(),
            'alumAsisteDentista' => new AlumAsisteDentista(),
            'usoAnteojosSeleccionados' => [],
        ];
    }

    private function getTratamientosDefaults(): array
    {
        return [
            'tratamientos' => [new Tratamientos()],
        ];
    }

    private function getCatalogosData(): array
    {
        return [
            'catalogoDependenciasOptions' => CatalogoDependenciasEconomicas::dropdownDependientesOptions(),
            'otroCatalogoDependenciaId' => CatalogoDependenciasEconomicas::getOtroId(),
            'tiposViviendasMap' => TiposViviendas::dropdownOptions(),
            'tipoViviendaOtroId' => TiposViviendas::getOtroId(),
            'catalogoBienesOptions' => CatalogoBienesVivienda::dropdownOptions(),
            'catalogoBienOtroId' => CatalogoBienesVivienda::getOtroId(),
            'catalogoServiciosViviendaOptions' => CatalogoServiciosVivienda::dropdownOptions(),
            'catalogoServicioOtroId' => CatalogoServiciosVivienda::getOtroId(),
            'catalogoBienesPersonalesOptions' => CatalogoBienesPersonales::dropdownOptions(),
            'catalogoTransportesMap' => CatalogoTransportes::dropdownOptions(),
            'tiemposRecorridoMap' => TiempoRecorridoTransporte::dropdownOptions(),
            'catalogoEnfermCronicasMap' => CatalogoEnfermCronicas::dropdownOptions(),
            'otroCatalogoEnfermCronicaId' => CatalogoEnfermCronicas::getOtroId(),
            'catalogoCigarrosDiaMap' => CatalogoCigarrosDia::dropdownOptions(),
            'catalogoLugaresComerMap' => CatalogoLugaresComer::dropdownOptions(),
            'catalogoLugarComerOtroId' => CatalogoLugaresComer::getOtroId(),
            'catalogoAlimentosMap' => CatalogoAlimentos::dropdownOptions(),
            'frecuenciasVecesMap' => FrecuenciaVeces::dropdownOptions(),
            'catalogoDeportesMap' => CatalogoDeportes::dropdownOptions(),
            'catalogoActividadesEjercicioMap' => CatalogoActividadEjercicio::dropdownOptions(),
            'frecuenciasVecesSemanaMap' => FrecuenciaVecesSemana::dropdownOptions(),
            'catalogoAlergiasMap' => CatalogoAlergias::dropdownOptions(),
            'catalogoProblemasSaludMap' => CatalogoProblemasSalud::dropdownOptions(),
            'catalogoReaccionesAlergicasMap' => CatalogoReaccionesAlergicas::dropdownOptions(),
            'catalogoServiciosSaludMap' => CatalogoServiciosSalud::dropdownOptions(),
            'catalogoTratamientosMap' => CatalogoTratamientos::dropdownOptions(),
            'catalogoUsoAnteojosMap' => CatalogoUsoAnteojos::dropdownOptions(),
            'frecuenciasTiempoMap' => FrecuenciaTiempo::dropdownOptions(),
            'tipoGravedadMap' => TipoGravedad::dropdownOptions(),
            'otroCatalogoProblemaId' => CatalogoProblemasSalud::getOtroId(),
            'catalogoLugaresAccesoMap' => CatalogoLugaresAccesoPrincipal::dropdownOptions(),
            'catalogoUsosInternetMap' => CatalogoUsosInternet::dropdownOptions(),
            'catalogoOrganizacionesGrouped' => CatalogoOrganizaciones::groupedOptionsByTipo(),
            'catalogoOrganizacionOtroId' => CatalogoOrganizaciones::getOtroId(),
        ];
    }
}
