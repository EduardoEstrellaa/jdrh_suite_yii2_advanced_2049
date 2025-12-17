<?php

namespace common\services\support;

use DomainException;
use common\models\AlumEstadoSalud;
use common\models\CatalogoProblemasSalud;
use common\models\ProblemasSalud;

class ProblemasSaludManager
{
    /**
     * Sincroniza los problemas de salud asociados a un alumno.
     */
    public static function sync(AlumEstadoSalud $alumEstadoSalud, array $post): void
    {
        if ($alumEstadoSalud->isNewRecord || !$alumEstadoSalud->id) {
            throw new DomainException('No se pudo asociar problemas de salud sin un registro base guardado.');
        }

        if ((int)$alumEstadoSalud->tuvo_problema_salud !== 1) {
            ProblemasSalud::deleteAll(['alum_estado_salud_id' => $alumEstadoSalud->id]);
            return;
        }

        $rows = $post['ProblemasSalud'] ?? [];
        $problemas = [];

        foreach ($rows as $row) {
            $problema = self::mapRowToModel($alumEstadoSalud->id, $row);
            if ($problema !== null) {
                $problemas[] = $problema;
            }
        }

        if (empty($problemas)) {
            throw new DomainException('Agrega al menos un problema de salud o indica que no los has tenido.');
        }

        ProblemasSalud::deleteAll(['alum_estado_salud_id' => $alumEstadoSalud->id]);

        foreach ($problemas as $problema) {
            if (!$problema->save()) {
                throw new DomainException('Error al guardar problema de salud: ' . json_encode($problema->errors));
            }
        }
    }

    private static function mapRowToModel(int $alumEstadoSaludId, array $row): ?ProblemasSalud
    {
        $selected = isset($row['selected']) && (int)$row['selected'] === 1;
        if (!$selected) {
            return null;
        }

        $catalogoId = (int)($row['catalogo_problemas_salud_id'] ?? 0);
        $gravedadId = (int)($row['tipo_gravedad_id'] ?? 0);
        $otro = trim((string)($row['otro_especificar'] ?? ''));

        if ($catalogoId <= 0) {
            throw new DomainException('Cada problema de salud requiere tipo y gravedad.');
        }

        if ($gravedadId <= 0) {
            throw new DomainException('Selecciona la gravedad para cada problema marcado.');
        }

        $otroId = CatalogoProblemasSalud::getOtroId();
        if ($otroId !== null && $catalogoId === (int)$otroId) {
            if ($otro === '') {
                throw new DomainException('Especifica el problema de salud cuando elijas "Otro".');
            }
        } else {
            $otro = null;
        }

        $problema = new ProblemasSalud([
            'alum_estado_salud_id' => $alumEstadoSaludId,
            'catalogo_problemas_salud_id' => $catalogoId,
            'tipo_gravedad_id' => $gravedadId,
        ]);

        if ($otro !== null) {
            $problema->otro_especificar = $otro;
        }

        return $problema;
    }
}
