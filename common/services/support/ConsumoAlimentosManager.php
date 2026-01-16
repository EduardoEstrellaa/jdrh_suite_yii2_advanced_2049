<?php

namespace common\services\support;

use DomainException;
use common\models\AlumConsumoAlimentos;

class ConsumoAlimentosManager
{
    /**
     * Sincroniza el consumo de alimentos de un alumno.
     */
    public static function sync(int $alumnoId, array $post): void
    {
        $rows = $post['AlumConsumoAlimentos'] ?? [];
        AlumConsumoAlimentos::deleteAll(['alumnos_id' => $alumnoId]);

        foreach ($rows as $row) {
            $alimentoId = (int)($row['catalogo_alimentos_id'] ?? 0);
            $frecuenciaId = (int)($row['frecuencia_veces_id'] ?? 0);
            if ($alimentoId <= 0 || $frecuenciaId <= 0) {
                continue;
            }

            $consumo = new AlumConsumoAlimentos([
                'alumnos_id' => $alumnoId,
                'catalogo_alimentos_id' => $alimentoId,
                'frecuencia_veces_id' => $frecuenciaId,
            ]);

            if (!$consumo->save()) {
                throw new DomainException('Error al guardar consumo de alimentos: ' . json_encode($consumo->errors));
            }
        }
    }
}
