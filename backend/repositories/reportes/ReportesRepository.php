<?php

namespace backend\repositories\reportes;

use common\models\Alumnos;
use common\models\AsignacionesGrupos;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Repository con consultas reutilizables para reportes.
 */
class ReportesRepository
{
    /**
     * Construye la consulta base de asignaciones con relaciones necesarias.
     */
    public function crearAsignacionQuery(): ActiveQuery
    {
        return AsignacionesGrupos::find()
            ->alias('ag')
            ->joinWith(['ciclosSemestres cs'])
            ->with([
                'asignacionesTutores.perfil',
                'grupos',
                'semestres',
                'asignacionesAlumnosGrupos.alumInscripciones.alumnos.perfil',
                'ciclosSemestres',
            ]);
    }

    /**
     * Prepara la consulta base de alumnos con filtros de ciclo y grupo.
     */
    public function crearBaseAlumnoQuery(?int $cicloId, ?int $grupoId, array $with = []): ActiveQuery
    {
        $query = Alumnos::find()->alias('a')
            ->leftJoin('alum_inscripciones ins', 'ins.alumnos_id = a.id')
            ->leftJoin('ciclos_semestres cs', 'cs.id = ins.ciclos_semestres_id')
            ->leftJoin('asignaciones_alumnos_grupos aag', 'aag.alum_inscripciones_id = ins.id')
            ->leftJoin('asignaciones_grupos ag', 'ag.id = aag.asignaciones_grupos_id')
            ->groupBy('a.id');

        if ($with) {
            $query->with($with);
        }

        if ($cicloId) {
            $query->andWhere(['cs.ciclos_escolares_id' => $cicloId]);
        }

        if ($grupoId) {
            $query->andWhere(['ag.grupos_id' => $grupoId]);
        }

        return $query;
    }

    /**
     * Devuelve expresiones predefinidas para detectar condiciones medicas.
     */
    public function crearCondicionExpressions(string $alumnoAlias = 'a', string $estadoAlias = 'aes'): array
    {
        return [
            new Expression("EXISTS (SELECT 1 FROM problemas_salud ps WHERE ps.alum_estado_salud_id = {$estadoAlias}.id)"),
            new Expression("EXISTS (SELECT 1 FROM alum_servicios_salud ass WHERE ass.alumnos_id = {$alumnoAlias}.id AND ass.tiene_servicios_salud = 1)"),
            new Expression("EXISTS (SELECT 1 FROM alum_tratamientos atr WHERE atr.alumnos_id = {$alumnoAlias}.id AND atr.esta_en_tratamiento = 1)"),
            new Expression("EXISTS (SELECT 1 FROM alum_alergia aal WHERE aal.alumnos_id = {$alumnoAlias}.id AND aal.padeces_alergias = 1)"),
            new Expression("EXISTS (SELECT 1 FROM alum_enfermedades_cronicas aec WHERE aec.alumnos_id = {$alumnoAlias}.id AND aec.padece_enfermedades_cronicas = 1)"),
        ];
    }
}
