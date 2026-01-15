<?php

namespace backend\forms\reportes;

/**
 * Request de filtros para el reporte de becas y apoyos.
 */
class BecasApoyosReportRequest extends BaseReportRequest
{
    protected const INT_ATTRIBUTES = [
        'generacion_id',
        'tipo_beca_id',
        'ciclo_escolar_id',
    ];

    protected const BOOL_ATTRIBUTES = [
        'solo_con_beca',
    ];

    public ?int $generacion_id = null;
    public ?int $tipo_beca_id = null;
    public bool $solo_con_beca = false;
    public ?int $ciclo_escolar_id = null;

    public function rules(): array
    {
        return [
            [['generacion_id', 'tipo_beca_id', 'ciclo_escolar_id'], 'integer'],
            ['solo_con_beca', 'boolean'],
        ];
    }

    /**
     * Devuelve los filtros compactados para la vista.
     */
    public function obtenerFiltros(): array
    {
        return [
            'generacionId' => $this->generacion_id,
            'tipoBecaId' => $this->tipo_beca_id,
            'soloConBeca' => $this->solo_con_beca,
            'cicloId' => $this->ciclo_escolar_id,
        ];
    }
}
