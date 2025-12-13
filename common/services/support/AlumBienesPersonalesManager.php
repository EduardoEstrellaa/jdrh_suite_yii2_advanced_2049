<?php

namespace common\services\support;

use DomainException;
use common\models\AlumBienesPersonales;

class AlumBienesPersonalesManager
{
    /**
     * Sincroniza los bienes personales seleccionados para el alumno.
     */
    public static function sync(int $alumnoId, array $post): void
    {
        if ($alumnoId <= 0) {
            throw new DomainException('No se pudo asociar los bienes personales sin un alumno válido.');
        }

        $bienIds = $post['BienesPersonales']['ids'] ?? [];

        AlumBienesPersonales::deleteAll(['alumnos_id' => $alumnoId]);

        foreach ($bienIds as $bienId) {
            $bienId = (int)$bienId;
            if ($bienId <= 0) {
                continue;
            }

            $bienPersonal = new AlumBienesPersonales([
                'alumnos_id' => $alumnoId,
                'catalogo_bienes_personales_id' => $bienId,
            ]);

            if (!$bienPersonal->save()) {
                throw new DomainException('Error al guardar bien personal: ' . json_encode($bienPersonal->errors));
            }
        }
    }
}
