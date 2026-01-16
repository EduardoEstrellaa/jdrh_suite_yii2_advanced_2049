<?php

namespace backend\forms\reportes;

use yii\db\ActiveQuery;

/**
 * Request de filtros para el reporte de asignaciones de tutores.
 */
class AsignacionTutoresReportRequest extends BaseReportRequest
{
    protected const INT_ATTRIBUTES = [
        'ciclo_escolar_id',
        'semestre_id',
        'grupo_id',
        'tutor_id',
    ];

    public ?int $ciclo_escolar_id = null;
    public ?int $semestre_id = null;
    public ?int $grupo_id = null;
    public ?int $tutor_id = null;

    public function rules(): array
    {
        return [
            [self::INT_ATTRIBUTES, 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'ciclo_escolar_id' => 'Ciclo escolar',
            'semestre_id' => 'Semestre',
            'grupo_id' => 'Grupo',
            'tutor_id' => 'Tutor',
        ];
    }

    /**
     * Aplica los filtros validados a la consulta principal de asignaciones.
     */
    public function applyToQuery(ActiveQuery $query, string $ciclosAlias = 'cs'): void
    {
        if ($this->ciclo_escolar_id) {
            $query->andWhere(["{$ciclosAlias}.ciclos_escolares_id" => $this->ciclo_escolar_id]);
        }
        if ($this->semestre_id) {
            $query->andWhere(["{$ciclosAlias}.semestres_id" => $this->semestre_id]);
        }
        if ($this->grupo_id) {
            $query->andWhere(['grupos_id' => $this->grupo_id]);
        }
        if ($this->tutor_id) {
            $query->andWhere(['asignaciones_tutores_id' => $this->tutor_id]);
        }
    }

    /**
     * Retorna un resumen sencillo de los filtros activos.
     */
    public function getResumen(): array
    {
        return [
            'cicloId' => $this->ciclo_escolar_id,
            'semestreId' => $this->semestre_id,
            'grupoId' => $this->grupo_id,
            'tutorId' => $this->tutor_id,
        ];
    }
}
