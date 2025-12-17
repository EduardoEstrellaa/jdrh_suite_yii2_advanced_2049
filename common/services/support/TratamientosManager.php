<?php

namespace common\services\support;

use DomainException;
use common\models\AlumTratamientos;
use common\models\Tratamientos;

class TratamientosManager
{
    /**
     * Sincroniza los tratamientos asociados a un alumno.
     */
    public static function sync(AlumTratamientos $alumTratamientos, array $post): void
    {
        if ($alumTratamientos->isNewRecord || !$alumTratamientos->id) {
            throw new DomainException('No se pudo asociar tratamientos sin un registro base guardado.');
        }

        if ((int)$alumTratamientos->esta_en_tratamiento !== 1) {
            Tratamientos::deleteAll(['alum_tratamientos_id' => $alumTratamientos->id]);
            return;
        }

        $rows = $post['Tratamientos'] ?? [];
        $tratamientos = [];

        foreach ($rows as $row) {
            $tratamiento = self::mapRowToModel($alumTratamientos->id, $row);
            if ($tratamiento !== null) {
                $tratamientos[] = $tratamiento;
            }
        }

        if (empty($tratamientos)) {
            throw new DomainException('Agrega al menos un tratamiento o indica que no estas en tratamiento.');
        }

        Tratamientos::deleteAll(['alum_tratamientos_id' => $alumTratamientos->id]);

        foreach ($tratamientos as $tratamiento) {
            if (!$tratamiento->save()) {
                throw new DomainException('Error al guardar tratamiento: ' . json_encode($tratamiento->errors));
            }
        }
    }

    private static function mapRowToModel(int $alumTratamientosId, array $row): ?Tratamientos
    {
        $selected = isset($row['selected']) && (int)$row['selected'] === 1;
        if (!$selected) {
            return null;
        }

        $catalogoId = (int)($row['catalogo_tratamientos_id'] ?? 0);
        $frecuenciaId = (int)($row['frecuencia_tiempo_id'] ?? 0);
        $fechaInicio = trim((string)($row['fecha_inicio'] ?? ''));
        $fechaFin = trim((string)($row['fecha_fin'] ?? ''));

        if ($catalogoId <= 0) {
            throw new DomainException('Cada tratamiento requiere tipo y frecuencia.');
        }

        if ($frecuenciaId <= 0) {
            throw new DomainException('Selecciona la frecuencia para cada tratamiento marcado.');
        }

        if ($fechaFin !== '' && $fechaInicio !== '' && strtotime($fechaFin) < strtotime($fechaInicio)) {
            throw new DomainException('La fecha fin debe ser igual o posterior a la fecha de inicio.');
        }

        $tratamiento = new Tratamientos([
            'alum_tratamientos_id' => $alumTratamientosId,
            'catalogo_tratamientos_id' => $catalogoId,
            'frecuencia_tiempo_id' => $frecuenciaId,
        ]);

        if ($fechaInicio !== '') {
            $tratamiento->fecha_inicio = $fechaInicio;
        }
        if ($fechaFin !== '') {
            $tratamiento->fecha_fin = $fechaFin;
        }

        return $tratamiento;
    }
}
