<?php

namespace common\services;

use DomainException;
use Yii;
use common\models\AlumDependenEconomica;
use common\models\AlumInfoHijos;
use common\models\CatalogoDependenciasEconomicas;
use common\models\Dependientes;
use common\models\EdadesHijos;
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
            'dependientes' => [],
            'dependientesSeleccionados' => [],
            'dependientesOtro' => null,
            'edadesHijos' => [],
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

        return array_merge($models, $dependientesData, [
            'edadesHijos' => $edadesHijos,
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
    private function buildDependientesData(AlumDependenEconomica $alumDependenEconomica = null)
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
    private function getEdadesHijos(AlumInfoHijos $alumInfoHijos = null)
    {
        if ($alumInfoHijos === null || $alumInfoHijos->isNewRecord) {
            return [];
        }

        return EdadesHijos::findAll([
            'alum_info_hijos_id' => $alumInfoHijos->id,
        ]);
    }
}
