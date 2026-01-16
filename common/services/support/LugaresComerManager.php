<?php

namespace common\services\support;

use DomainException;
use common\models\AlumLugaresComer;
use common\models\CatalogoLugaresComer;

class LugaresComerManager
{
    /**
     * Sincroniza los lugares donde come un alumno.
     */
    public static function sync(int $alumnoId, array $post): void
    {
        $rows = $post['AlumLugaresComer'] ?? [];
        AlumLugaresComer::deleteAll(['alumnos_id' => $alumnoId]);

        foreach ($rows as $row) {
            $catalogoId = (int)($row['catalogo_lugares_comer_id'] ?? 0);
            if ($catalogoId <= 0) {
                continue;
            }

            $otro = trim((string)($row['otro_especificar'] ?? ''));
            $otroId = CatalogoLugaresComer::getOtroId();
            $esOtro = $otroId !== null && $catalogoId === (int)$otroId;

            if ($esOtro && $otro === '') {
                throw new DomainException('Especifica el lugar de comida en "Otro".');
            }

            $lugar = new AlumLugaresComer([
                'alumnos_id' => $alumnoId,
                'catalogo_lugares_comer_id' => $catalogoId,
                'otro_especificar' => $otro !== '' ? $otro : null,
            ]);

            if (!$lugar->save()) {
                throw new DomainException('Error al guardar lugares donde comes: ' . json_encode($lugar->errors));
            }
        }
    }
}
