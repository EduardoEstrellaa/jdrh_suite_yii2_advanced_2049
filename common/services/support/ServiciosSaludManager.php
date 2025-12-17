<?php

namespace common\services\support;

use DomainException;
use common\models\AlumServiciosSalud;
use common\models\ServiciosSalud;

class ServiciosSaludManager
{
    /**
     * Sincroniza los servicios de salud asociados a un alumno.
     */
    public static function sync(AlumServiciosSalud $alumServiciosSalud, array $post): void
    {
        if ($alumServiciosSalud->isNewRecord || !$alumServiciosSalud->id) {
            throw new DomainException('No se pudo asociar servicios de salud sin un registro base guardado.');
        }

        if ((int)$alumServiciosSalud->tiene_servicios_salud !== 1) {
            ServiciosSalud::deleteAll(['alum_servicios_salud_id' => $alumServiciosSalud->id]);
            return;
        }

        $ids = $post['ServiciosSalud']['ids'] ?? [];
        if (count($ids) < 1) {
            throw new DomainException('Selecciona al menos un servicio de salud.');
        }

        ServiciosSalud::deleteAll(['alum_servicios_salud_id' => $alumServiciosSalud->id]);

        foreach ($ids as $id) {
            $id = (int)$id;
            if ($id <= 0) {
                continue;
            }

            $servicio = new ServiciosSalud([
                'alum_servicios_salud_id' => $alumServiciosSalud->id,
                'catalogo_servicios_salud_id' => $id,
            ]);

            if (!$servicio->save()) {
                throw new DomainException('Error al guardar servicio de salud: ' . json_encode($servicio->errors));
            }
        }
    }
}
