<?php

namespace common\services\support;

use DomainException;
use common\models\AlumVivienda;
use common\models\CatalogoBienesVivienda;
use common\models\ViviendaBienes;

class ViviendaBienesManager
{
    /**
     * Sincroniza los bienes de vivienda seleccionados en el formulario.
     */
    public static function sync(AlumVivienda $alumVivienda, array $post): void
    {
        if ($alumVivienda->isNewRecord || !$alumVivienda->id) {
            throw new DomainException('No se pudo asociar los bienes sin una vivienda guardada.');
        }

        $bienIds = $post['ViviendaBienes']['ids'] ?? [];
        $otroTexto = isset($post['ViviendaBienes']['otro_especificar'])
            ? trim((string)$post['ViviendaBienes']['otro_especificar'])
            : null;
        $otroId = CatalogoBienesVivienda::getOtroId();

        ViviendaBienes::deleteAll(['alum_vivienda_id' => $alumVivienda->id]);

        foreach ($bienIds as $bienId) {
            $bienId = (int)$bienId;
            if ($bienId <= 0) {
                continue;
            }

            $bien = new ViviendaBienes([
                'alum_vivienda_id' => $alumVivienda->id,
                'catalogo_bienes_vivienda_id' => $bienId,
            ]);

            if ($otroId !== null && $bienId === $otroId) {
                if ($otroTexto === null || $otroTexto === '') {
                    throw new DomainException('Debes especificar el texto para "Otro" en bienes de vivienda.');
                }
                $bien->otro_especificar = $otroTexto;
            }

            if (!$bien->save()) {
                throw new DomainException('Error al guardar bien de vivienda: ' . json_encode($bien->errors));
            }
        }
    }
}
