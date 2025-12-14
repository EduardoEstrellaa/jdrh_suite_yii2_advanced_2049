<?php

namespace common\services\support;

use DomainException;
use common\models\AlumVivienda;
use common\models\CatalogoServiciosVivienda;
use common\models\ViviendaServicios;

class ViviendaServiciosManager
{
    /**
     * Sincroniza los servicios de vivienda seleccionados en el formulario.
     */
    public static function sync(AlumVivienda $alumVivienda, array $post): void
    {
        if ($alumVivienda->isNewRecord || !$alumVivienda->id) {
            throw new DomainException('No se pudo asociar los servicios sin una vivienda guardada.');
        }

        $serviciosIds = $post['ViviendaServicios']['ids'] ?? [];
        $otroTexto = isset($post['ViviendaServicios']['otro_especificar'])
            ? trim((string)$post['ViviendaServicios']['otro_especificar'])
            : null;
        $otroId = CatalogoServiciosVivienda::getOtroId();

        ViviendaServicios::deleteAll(['alum_vivienda_id' => $alumVivienda->id]);

        foreach ($serviciosIds as $servicioId) {
            $servicioId = (int)$servicioId;
            if ($servicioId <= 0) {
                continue;
            }

            $servicio = new ViviendaServicios([
                'alum_vivienda_id' => $alumVivienda->id,
                'catalogo_servicios_vivienda_id' => $servicioId,
            ]);

            if ($otroId !== null && $servicioId === $otroId) {
                if ($otroTexto === null || $otroTexto === '') {
                    throw new DomainException('Debes especificar el texto para "Otro" en servicios de vivienda.');
                }
                $servicio->otro_especificar = $otroTexto;
            }

            if (!$servicio->save()) {
                throw new DomainException('Error al guardar servicio de vivienda: ' . json_encode($servicio->errors));
            }
        }
    }
}
