<?php

namespace common\services\support;

use DomainException;
use common\models\AlumEnfermedadesCronicas;
use common\models\EnfermedadesCronicas;
use common\models\CatalogoEnfermCronicas;

class EnfermedadesCronicasManager
{
    /**
     * Sincroniza las enfermedades crónicas asociadas a un alumno.
     */
    public static function sync(AlumEnfermedadesCronicas $alumEnfermedadesCronicas, array $post): void
    {
        if ($alumEnfermedadesCronicas->isNewRecord || !$alumEnfermedadesCronicas->id) {
            throw new DomainException('No se pudo asociar enfermedades crónicas sin un registro base guardado.');
        }

        if ((int)$alumEnfermedadesCronicas->padece_enfermedades_cronicas !== 1) {
            EnfermedadesCronicas::deleteAll(['alum_enfermedades_cronicas_id' => $alumEnfermedadesCronicas->id]);
            return;
        }

        $rows = $post['EnfermedadesCronicas'] ?? [];
        $registros = [];

        foreach ($rows as $row) {
            $modelo = self::mapRowToModel($alumEnfermedadesCronicas->id, $row);
            if ($modelo !== null) {
                $registros[] = $modelo;
            }
        }

        if (empty($registros)) {
            throw new DomainException('Agrega al menos una enfermedad crónica o indica que no las padeces.');
        }

        EnfermedadesCronicas::deleteAll(['alum_enfermedades_cronicas_id' => $alumEnfermedadesCronicas->id]);

        foreach ($registros as $enfermedad) {
            if (!$enfermedad->save()) {
                throw new DomainException('Error al guardar enfermedades crónicas: ' . json_encode($enfermedad->errors));
            }
        }
    }

    private static function mapRowToModel(int $alumEnfermedadesCronicasId, array $row): ?EnfermedadesCronicas
    {
        $selected = isset($row['selected']) && (int)$row['selected'] === 1;
        if (!$selected) {
            return null;
        }

        $catalogoId = (int)($row['catalogo_enferm_cronicas_id'] ?? 0);
        $otro = trim((string)($row['otro_especificar'] ?? ''));
        $otroId = CatalogoEnfermCronicas::getOtroId();
        $esOtro = $otroId !== null && $catalogoId === (int)$otroId;

        if ($catalogoId <= 0) {
            throw new DomainException('Cada enfermedad marcada requiere un tipo.');
        }

        if ($esOtro && $otro === '') {
            throw new DomainException('Especifica la enfermedad crónica en "Otro".');
        }

        return new EnfermedadesCronicas([
            'alum_enfermedades_cronicas_id' => $alumEnfermedadesCronicasId,
            'catalogo_enferm_cronicas_id' => $catalogoId,
            'otro_especificar' => $otro !== '' ? $otro : null,
        ]);
    }
}
