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
        [$fechaInicio, $fechaFin] = self::extractFechas($row);

        if ($catalogoId <= 0) {
            throw new DomainException('Cada tratamiento requiere tipo y frecuencia.');
        }

        if ($frecuenciaId <= 0) {
            throw new DomainException('Selecciona la frecuencia para cada tratamiento marcado.');
        }

        if ($fechaFin !== null && $fechaInicio !== null && strtotime($fechaFin) < strtotime($fechaInicio)) {
            throw new DomainException('La fecha fin debe ser igual o posterior a la fecha de inicio.');
        }

        $tratamiento = new Tratamientos([
            'alum_tratamientos_id' => $alumTratamientosId,
            'catalogo_tratamientos_id' => $catalogoId,
            'frecuencia_tiempo_id' => $frecuenciaId,
        ]);

        if ($fechaInicio !== null) {
            $tratamiento->fecha_inicio = $fechaInicio;
        }
        if ($fechaFin !== null) {
            $tratamiento->fecha_fin = $fechaFin;
        }

        return $tratamiento;
    }

    /**
     * Obtiene fechas de inicio y fin desde el POST, tolerando rangos combinados.
     *
     * @return array{0: string|null, 1: string|null}
     */
    private static function extractFechas(array $row): array
    {
        $inicioRaw = $row['fecha_inicio'] ?? null;
        $finRaw = $row['fecha_fin'] ?? null;

        // Si viene solo el rango combinado, usalo para poblar ambos extremos.
        $rangoRaw = $row['fecha_rango'] ?? null;
        if ($rangoRaw === null && is_string($inicioRaw) && strpos($inicioRaw, ' - ') !== false && empty($finRaw)) {
            $rangoRaw = $inicioRaw;
        }

        if (is_string($rangoRaw) && strpos($rangoRaw, ' - ') !== false) {
            $parts = array_map('trim', explode(' - ', $rangoRaw, 2));
            $inicioRaw = $inicioRaw ?: ($parts[0] ?? null);
            $finRaw = $finRaw ?: ($parts[1] ?? null);
        }

        return [
            self::normalizeDate($inicioRaw),
            self::normalizeDate($finRaw),
        ];
    }

    /**
     * Normaliza fechas desde el form a YYYY-MM-DD evitando doble conversión.
     */
    private static function normalizeDate($value): ?string
    {
        $raw = trim((string)($value ?? ''));
        if ($raw === '') {
            return null;
        }

        $formats = ['Y-m-d', 'd/m/Y', 'Y/m/d'];
        foreach ($formats as $fmt) {
            $dt = \DateTime::createFromFormat($fmt, $raw);
            if ($dt && $dt->format($fmt) === $raw) {
                return $dt->format('Y-m-d');
            }
        }

        // Fallback: si llega en formato completo de rango u otro, intentamos parsear con strtotime.
        $ts = strtotime($raw);
        if ($ts !== false) {
            return date('Y-m-d', $ts);
        }

        return null;
    }
}
