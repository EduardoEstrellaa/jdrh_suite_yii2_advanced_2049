<?php

namespace common\services\support;

use DomainException;
use common\models\AlumEstadoSalud;
use common\models\CatalogoProblemasSalud;
use common\models\ProblemasSalud;

class ProblemasSaludManager
{
    /**
     * Sincroniza los problemas de salud asociados a un estado de salud.
     */
    public static function sync(AlumEstadoSalud $alumEstadoSalud, array $post): void
    {
        if ($alumEstadoSalud->isNewRecord || !$alumEstadoSalud->id) {
            throw new DomainException('No se pudo asociar problemas de salud sin un estado de salud guardado.');
        }

        if ((int)$alumEstadoSalud->tuvo_problema_salud !== 1) {
            ProblemasSalud::deleteAll(['alum_estado_salud_id' => $alumEstadoSalud->id]);
            return;
        }

        $rows = $post['ProblemasSalud'] ?? [];
        $otroId = CatalogoProblemasSalud::getOtroId();

        $problemas = [];
        foreach ($rows as $key => $row) {
            $problema = self::mapRowToModel($alumEstadoSalud->id, $row, (int)$key, $otroId);
            if ($problema !== null) {
                $problemas[] = $problema;
            }
        }

        if (empty($problemas)) {
            throw new DomainException('Debes capturar al menos un problema de salud.');
        }

        ProblemasSalud::deleteAll(['alum_estado_salud_id' => $alumEstadoSalud->id]);

        foreach ($problemas as $problema) {
            if (!$problema->save()) {
                throw new DomainException('Error al guardar problema de salud: ' . json_encode($problema->errors));
            }
        }
    }

    private static function mapRowToModel(int $alumEstadoSaludId, array $row, int $fallbackCatalogoId, ?int $otroId): ?ProblemasSalud
    {
        $selected = isset($row['selected']) && (int)$row['selected'] === 1;
        if (!$selected) {
            return null;
        }

        $catalogoId = isset($row['catalogo_problemas_salud_id'])
            ? (int)$row['catalogo_problemas_salud_id']
            : $fallbackCatalogoId;
        $tipoGravedadId = (int)($row['tipo_gravedad_id'] ?? 0);
        $otroTexto = trim((string)($row['otro_especificar'] ?? ''));

        if ($catalogoId <= 0 || $tipoGravedadId <= 0) {
            throw new DomainException('Debes seleccionar el problema de salud y su gravedad.');
        }

        $problema = new ProblemasSalud([
            'alum_estado_salud_id' => $alumEstadoSaludId,
            'catalogo_problemas_salud_id' => $catalogoId,
            'tipo_gravedad_id' => $tipoGravedadId,
        ]);

        if ($otroId !== null && $catalogoId === $otroId) {
            if ($otroTexto === '') {
                throw new DomainException('Debes especificar el problema de salud cuando eliges "Otro".');
            }
            $problema->otro_especificar = $otroTexto;
        }

        return $problema;
    }
}
