<?php

namespace common\services;

use DomainException;
use Yii;
use common\models\AlumDependenEconomica;
use common\models\AlumInfoHijos;
use common\models\AlumBienesPersonales;
use common\models\AlumVivienda;
use common\models\AlumEstadoSalud;
use common\models\CatalogoBienesPersonales;
use common\models\CatalogoBienesVivienda;
use common\models\CatalogoDependenciasEconomicas;
use common\models\CatalogoProblemasSalud;
use common\models\CatalogoServiciosVivienda;
use common\models\CatalogoTransportes;
use common\models\Dependientes;
use common\models\EdadesHijos;
use common\models\ProblemasSalud;
use common\models\TiempoRecorridoTransporte;
use common\models\TipoGravedad;
use common\models\TiposViviendas;
use common\models\ViviendaBienes;
use common\models\ViviendaServicios;
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
            $this->getSaludDefaults(),
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

        return array_merge(
            $models,
            $dependientesData,
            $bienesData,
            $serviciosData,
            $bienesPersonalesData,
            $problemasSaludData,
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
            return $this->getSaludDefaults();
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

    private function getViviendaDefaults(): array
    {
        return [
            'bienesSeleccionados' => [],
            'bienesOtro' => null,
        ];
    }

    private function getSaludDefaults(): array
    {
        return [
            'problemasSalud' => [new ProblemasSalud()],
        ];
    }

    private function getCatalogosData(): array
    {
        return [
            'catalogoDependenciasOptions' => CatalogoDependenciasEconomicas::dropdownOptions(),
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
            'catalogoProblemasSaludMap' => CatalogoProblemasSalud::dropdownOptions(),
            'tipoGravedadMap' => TipoGravedad::dropdownOptions(),
            'otroCatalogoProblemaId' => CatalogoProblemasSalud::getOtroId(),
        ];
    }
}
