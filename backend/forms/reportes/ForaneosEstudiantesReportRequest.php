<?php

namespace backend\forms\reportes;

/**
 * Request de filtros para el reporte de estudiantes foraneos.
 */
class ForaneosEstudiantesReportRequest extends BaseReportRequest
{
    protected const INT_ATTRIBUTES = [
        'generacion_id',
        'entidad_federativa_id',
        'municipio_id',
    ];

    public ?int $generacion_id = null;
    public ?int $entidad_federativa_id = null;
    public ?int $municipio_id = null;

    public function rules(): array
    {
        return [
            ['generacion_id', 'integer'],
            ['entidad_federativa_id', 'integer'],
            ['municipio_id', 'integer'],
        ];
    }

    /**
     * Retorna los filtros activos para reuso en la vista.
     */
    public function obtenerFiltros(): array
    {
        return [
            'generacionId' => $this->generacion_id,
            'entidadFederativaId' => $this->entidad_federativa_id,
            'municipioId' => $this->municipio_id,
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'generacion_id' => 'Generación',
            'entidad_federativa_id' => 'Entidad federativa',
            'municipio_id' => 'Municipio',
        ];
    }
}
