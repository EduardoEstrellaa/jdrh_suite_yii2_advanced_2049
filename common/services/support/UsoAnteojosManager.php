<?php

namespace common\services\support;

use DomainException;
use common\models\AlumUsoAnteojos;
use common\models\UsoAnteojos;

class UsoAnteojosManager
{
    /**
     * Sincroniza los tipos de uso de anteojos seleccionados.
     */
    public static function sync(AlumUsoAnteojos $alumUsoAnteojos, array $post): void
    {
        if ($alumUsoAnteojos->isNewRecord || !$alumUsoAnteojos->id) {
            throw new DomainException('No se pudo asociar uso de anteojos sin un registro base guardado.');
        }

        if ((int)$alumUsoAnteojos->utilizas_anteojos !== 1) {
            UsoAnteojos::deleteAll(['alum_uso_anteojos_id' => $alumUsoAnteojos->id]);
            return;
        }

        $ids = $post['UsoAnteojos']['ids'] ?? [];
        if (count($ids) < 1) {
            throw new DomainException('Selecciona al menos una opción de uso de anteojos.');
        }

        UsoAnteojos::deleteAll(['alum_uso_anteojos_id' => $alumUsoAnteojos->id]);

        $id = (int)reset($ids);
        if ($id <= 0) {
            throw new DomainException('Selecciona una opción válida de uso de anteojos.');
        }

        $uso = new UsoAnteojos([
            'alum_uso_anteojos_id' => $alumUsoAnteojos->id,
            'catalogo_uso_anteojos_id' => $id,
        ]);

        if (!$uso->save()) {
            throw new DomainException('Error al guardar uso de anteojos: ' . json_encode($uso->errors));
        }
    }
}
