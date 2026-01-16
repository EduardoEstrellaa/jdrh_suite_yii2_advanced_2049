<?php

namespace backend\forms\reportes;

/**
 * Request de filtros para el reporte de canalizacion de riesgo.
 */
class RiesgoCanalizacionReportRequest extends BaseReportRequest
{
    protected const INT_ATTRIBUTES = [
        'ciclo_escolar_id',
        'grupo_id',
    ];

    public ?int $ciclo_escolar_id = null;
    public ?int $grupo_id = null;
    public ?string $nivel_riesgo = null;

    public function rules(): array
    {
        return [
            [['ciclo_escolar_id', 'grupo_id'], 'integer'],
            ['nivel_riesgo', 'string'],
        ];
    }

    /**
     * Devuelve un arreglo simple con los filtros ingresados.
     */
    public function obtenerFiltros(): array
    {
        return [
            'cicloId' => $this->ciclo_escolar_id,
            'grupoId' => $this->grupo_id,
            'nivelRiesgo' => $this->nivel_riesgo,
        ];
    }
}
