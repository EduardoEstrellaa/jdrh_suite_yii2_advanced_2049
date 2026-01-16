<?php

namespace common\services\support;

use DomainException;
use common\models\AlumEjercicio;
use common\models\EjercicioFisico;

class EjercicioFisicoManager
{
    /**
     * Sincroniza las actividades de ejercicio fisico de un alumno.
     */
    public static function sync(AlumEjercicio $alumEjercicio, array $post): void
    {
        if ($alumEjercicio->isNewRecord || !$alumEjercicio->id) {
            throw new DomainException('No se pudo asociar ejercicio fisico sin un registro base guardado.');
        }

        if ((int)$alumEjercicio->haces_ejercicio_fisico !== 1) {
            EjercicioFisico::deleteAll(['alum_ejercicio_id' => $alumEjercicio->id]);
            return;
        }

        $rows = $post['EjercicioFisico'] ?? [];
        $ejercicios = [];

        foreach ($rows as $row) {
            $ejercicio = self::mapRowToModel($alumEjercicio->id, $row);
            if ($ejercicio !== null) {
                $ejercicios[] = $ejercicio;
            }
        }

        if (empty($ejercicios)) {
            throw new DomainException('Agrega al menos una actividad de ejercicio o indica que no realizas ejercicio fisico.');
        }

        EjercicioFisico::deleteAll(['alum_ejercicio_id' => $alumEjercicio->id]);

        foreach ($ejercicios as $ejercicio) {
            if (!$ejercicio->save()) {
                throw new DomainException('Error al guardar ejercicio fisico: ' . json_encode($ejercicio->errors));
            }
        }
    }

    private static function mapRowToModel(int $alumEjercicioId, array $row): ?EjercicioFisico
    {
        $selected = isset($row['selected']) && (int)$row['selected'] === 1;
        if (!$selected) {
            return null;
        }

        $catalogoId = (int)($row['catalogo_actividad_ejercicio_id'] ?? 0);
        $frecuenciaId = (int)($row['frecuencia_veces_semana_id'] ?? 0);

        if ($catalogoId <= 0) {
            throw new DomainException('Selecciona el tipo de actividad de ejercicio fisico.');
        }

        if ($frecuenciaId <= 0) {
            throw new DomainException('Indica la frecuencia semanal para cada actividad seleccionada.');
        }

        return new EjercicioFisico([
            'alum_ejercicio_id' => $alumEjercicioId,
            'catalogo_actividad_ejercicio_id' => $catalogoId,
            'frecuencia_veces_semana_id' => $frecuenciaId,
        ]);
    }
}
