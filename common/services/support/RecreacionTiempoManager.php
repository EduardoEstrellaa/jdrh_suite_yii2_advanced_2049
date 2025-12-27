<?php

namespace common\services\support;

use DomainException;
use common\models\AlumRecreacionTiempo;
use common\models\UsosInternet;

class RecreacionTiempoManager
{
    /**
     * Sincroniza los usos de internet asociados al registro de recreación.
     */
    public static function sync(AlumRecreacionTiempo $alumRecreacionTiempo, array $post): void
    {
        if ($alumRecreacionTiempo->isNewRecord || !$alumRecreacionTiempo->id) {
            throw new DomainException('No se pudo asociar usos de internet sin un registro base guardado.');
        }

        $sabeUsar = (int)$alumRecreacionTiempo->sabes_usar_internet === 1;
        $tieneAcceso = (int)$alumRecreacionTiempo->tienes_acceso_internet === 1;

        if (!$sabeUsar || !$tieneAcceso) {
            UsosInternet::deleteAll(['alum_recreacion_tiempo_id' => $alumRecreacionTiempo->id]);
            return;
        }

        $ids = $post['UsosInternet']['ids'] ?? [];
        $ids = array_unique(array_map('intval', (array)$ids));
        $ids = array_values(array_filter($ids, static function ($id) {
            return $id > 0;
        }));

        if (count($ids) < 1) {
            throw new DomainException('Selecciona al menos un uso de internet.');
        }

        UsosInternet::deleteAll(['alum_recreacion_tiempo_id' => $alumRecreacionTiempo->id]);

        foreach ($ids as $id) {
            $uso = new UsosInternet([
                'alum_recreacion_tiempo_id' => $alumRecreacionTiempo->id,
                'catalogo_usos_internet_id' => $id,
            ]);

            if (!$uso->save()) {
                throw new DomainException('Error al guardar uso de internet: ' . json_encode($uso->errors));
            }
        }
    }
}
