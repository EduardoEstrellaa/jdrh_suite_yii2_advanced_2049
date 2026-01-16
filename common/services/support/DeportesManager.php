<?php

namespace common\services\support;

use DomainException;
use common\models\AlumDeportes;
use common\models\Deportes;

class DeportesManager
{
    /**
     * Sincroniza los deportes asociados a un alumno.
     */
    public static function sync(AlumDeportes $alumDeportes, array $post): void
    {
        if ($alumDeportes->isNewRecord || !$alumDeportes->id) {
            throw new DomainException('No se pudo asociar deportes sin un registro base guardado.');
        }

        if ((int)$alumDeportes->practicas_algun_deporte !== 1) {
            Deportes::deleteAll(['alum_deportes_id' => $alumDeportes->id]);
            return;
        }

        $rows = $post['Deportes'] ?? [];
        $deportes = [];

        foreach ($rows as $row) {
            $deporte = self::mapRowToModel($alumDeportes->id, $row);
            if ($deporte !== null) {
                $deportes[] = $deporte;
            }
        }

        if (empty($deportes)) {
            throw new DomainException('Agrega al menos un deporte o indica que no practicas deportes.');
        }

        Deportes::deleteAll(['alum_deportes_id' => $alumDeportes->id]);

        foreach ($deportes as $deporte) {
            if (!$deporte->save()) {
                throw new DomainException('Error al guardar deporte: ' . json_encode($deporte->errors));
            }
        }
    }

    private static function mapRowToModel(int $alumDeportesId, array $row): ?Deportes
    {
        $selected = isset($row['selected']) && (int)$row['selected'] === 1;
        if (!$selected) {
            return null;
        }

        $catalogoId = (int)($row['catalogo_deportes_id'] ?? 0);

        if ($catalogoId <= 0) {
            throw new DomainException('Cada deporte seleccionado debe corresponder a un catalogo valido.');
        }

        return new Deportes([
            'alum_deportes_id' => $alumDeportesId,
            'catalogo_deportes_id' => $catalogoId,
        ]);
    }
}
