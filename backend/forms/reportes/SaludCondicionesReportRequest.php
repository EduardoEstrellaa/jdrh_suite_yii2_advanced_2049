<?php

namespace backend\forms\reportes;

/**
 * Request de filtros para el reporte de salud y condiciones especiales.
 */
class SaludCondicionesReportRequest extends BaseReportRequest
{
    protected const INT_ATTRIBUTES = [
        'alumno_id',
        'grupo_id',
        'problema_id',
        'cronica_id',
        'alergia_id',
        'tratamiento_id',
    ];

    protected const BOOL_ATTRIBUTES = [
        'solo_con_condicion',
    ];

    public ?int $alumno_id = null;
    public ?int $grupo_id = null;
    public ?int $problema_id = null;
    public ?int $cronica_id = null;
    public ?int $alergia_id = null;
    public ?int $tratamiento_id = null;
    public ?string $matricula = null;
    public bool $solo_con_condicion = false;

    public function rules(): array
    {
        return [
            [['alumno_id', 'grupo_id', 'ciclo_escolar_id', 'problema_id', 'cronica_id', 'alergia_id', 'tratamiento_id'], 'integer'],
            ['solo_con_condicion', 'boolean'],
            ['matricula', 'trim'],
            ['matricula', 'string', 'max' => 32],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'grupo_id' => 'Grupo',
            'problema_id' => 'Problema de salud',
            'matricula' => 'Matrícula',
            'cronica_id' => 'Enfermedad crónica',
            'alergia_id' => 'Alergia',
            'tratamiento_id' => 'Tratamiento',
            'solo_con_condicion' => 'Solo con condición',
        ];
    }

    /**
     * Devuelve los filtros seleccionados en formato compacto.
     */
    public function obtenerFiltros(): array
    {
        return [
            'alumnoId' => $this->alumno_id,
            'grupoId' => $this->grupo_id,
            'problemaId' => $this->problema_id,
            'cronicaId' => $this->cronica_id,
            'alergiaId' => $this->alergia_id,
            'tratamientoId' => $this->tratamiento_id,
            'matricula' => $this->matricula,
            'soloConCondicion' => $this->solo_con_condicion,
        ];
    }
}
