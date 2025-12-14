<?php

namespace common\services;

use DomainException;
use Yii;
use common\models\AlumDependenEconomica;
use common\models\AlumInfoHijos;
use common\models\AlumBienesPersonales;
use common\models\AlumTransportes;
use common\models\AlumVivienda;
use common\models\CatalogoBienesPersonales;
use common\models\CatalogoBienesVivienda;
use common\models\CatalogoDependenciasEconomicas;
use common\models\CatalogoTransportes;
use common\models\Dependientes;
use common\models\EdadesHijos;
use common\models\TiempoRecorridoTransporte;
use common\models\TiposViviendas;
use common\models\ViviendaBienes;
use common\services\support\OperationResult;

/**
 * Fachada de aplicaciÇün para orquestar operaciones de expediente.
 */
class ExpedienteFacade
{
    /**
     * Datos iniciales para vista de creaciÇün.
     */
    public function getCreateData($perfil, $alumno)
    {
        $models = ExpedienteService::getModelsForCreate($perfil, $alumno);

        return array_merge($models, [
            'catalogoDependenciasOptions' => CatalogoDependenciasEconomicas::dropdownOptions(),
            'otroCatalogoDependenciaId' => CatalogoDependenciasEconomicas::getOtroId(),
            'dependientes' => [],
            'dependientesSeleccionados' => [],
            'dependientesOtro' => null,
            'edadesHijos' => [],
            'tiposViviendasMap' => TiposViviendas::dropdownOptions(),
            'tipoViviendaOtroId' => TiposViviendas::getOtroId(),
            'catalogoBienesOptions' => CatalogoBienesVivienda::dropdownOptions(),
            'catalogoBienOtroId' => CatalogoBienesVivienda::getOtroId(),
            'bienesSeleccionados' => [],
            'bienesOtro' => null,
            'catalogoBienesPersonalesOptions' => CatalogoBienesPersonales::dropdownOptions(),
            'bienesPersonalesSeleccionados' => [],
            'catalogoTransportesMap' => CatalogoTransportes::dropdownOptions(),
            'tiemposRecorridoMap' => TiempoRecorridoTransporte::dropdownOptions(),
        ]);
    }

    /**
     * Datos completos para vistas de actualizaciÇün/consulta.
     */
    public function getUpdateData($perfilId, $alumnoId)
    {
        $models = ExpedienteService::getModelsForUpdate($perfilId, $alumnoId);
        $dependientesData = $this->buildDependientesData($models['alumDependenEconomica']);
        $edadesHijos = $this->getEdadesHijos($models['alumInfoHijos']);
        $bienesData = $this->buildViviendaBienesData($models['alumVivienda']);
        $bienesPersonalesData = $this->buildBienesPersonalesData($alumnoId);

        return array_merge($models, $dependientesData, $bienesData, $bienesPersonalesData, [
            'edadesHijos' => $edadesHijos,
            'catalogoDependenciasOptions' => CatalogoDependenciasEconomicas::dropdownOptions(),
            'otroCatalogoDependenciaId' => CatalogoDependenciasEconomicas::getOtroId(),
            'tiposViviendasMap' => TiposViviendas::dropdownOptions(),
            'tipoViviendaOtroId' => TiposViviendas::getOtroId(),
            'catalogoBienesOptions' => CatalogoBienesVivienda::dropdownOptions(),
            'catalogoBienOtroId' => CatalogoBienesVivienda::getOtroId(),
            'catalogoBienesPersonalesOptions' => CatalogoBienesPersonales::dropdownOptions(),
            'catalogoTransportesMap' => CatalogoTransportes::dropdownOptions(),
            'tiemposRecorridoMap' => TiempoRecorridoTransporte::dropdownOptions(),
        ]);
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

    /**
     * Construye informaciÇün de dependientes seleccionados y texto de "Otro".
     */
    private function buildDependientesData(?AlumDependenEconomica $alumDependenEconomica = null)
    {
        if ($alumDependenEconomica === null || $alumDependenEconomica->isNewRecord) {
            return [
                'dependientes' => [],
                'dependientesSeleccionados' => [],
                'dependientesOtro' => null,
            ];
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

    /**
     * Obtiene edades de hijos asociadas.
     */
    private function getEdadesHijos(?AlumInfoHijos $alumInfoHijos = null)
    {
        if ($alumInfoHijos === null || $alumInfoHijos->isNewRecord) {
            return [];
        }

        return EdadesHijos::findAll([
            'alum_info_hijos_id' => $alumInfoHijos->id,
        ]);
    }

    /**
     * Construye informaciГіn de bienes seleccionados y texto para "Otro".
     */
    private function buildViviendaBienesData(?AlumVivienda $alumVivienda = null): array
    {
        if ($alumVivienda === null || $alumVivienda->isNewRecord) {
            return [
                'bienesSeleccionados' => [],
                'bienesOtro' => null,
            ];
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

    /**
     * Construye informaciÃ³n de bienes personales seleccionados.
     */
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
}
