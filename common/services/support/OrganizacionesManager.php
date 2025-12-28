<?php

namespace common\services\support;

use DomainException;
use common\models\AlumOrganizacion;
use common\models\CatalogoOrganizaciones;
use common\models\Organizaciones;

class OrganizacionesManager
{
    /**
     * Sincroniza las organizaciones en las que participa el alumno.
     */
    public static function sync(AlumOrganizacion $alumOrganizacion, array $post): void
    {
        if ($alumOrganizacion->isNewRecord || !$alumOrganizacion->id) {
            throw new DomainException('No se pudo asociar organizaciones sin un registro base guardado.');
        }

        if ((int)$alumOrganizacion->participas_organizacion !== 1) {
            Organizaciones::deleteAll(['alum_organizacion_id' => $alumOrganizacion->id]);
            return;
        }

        $rows = $post['Organizaciones'] ?? [];
        $organizaciones = [];
        $otroId = CatalogoOrganizaciones::getOtroId();
        $seen = [];

        foreach ($rows as $row) {
            $catalogoId = (int)($row['catalogo_organizaciones_id'] ?? 0);
            if ($catalogoId <= 0 || isset($seen[$catalogoId])) {
                continue;
            }
            $seen[$catalogoId] = true;

            $otra = trim((string)($row['otra_organizacion_especificar'] ?? ''));
            $esOtro = $otroId !== null && $catalogoId === (int)$otroId;

            if ($esOtro && $otra === '') {
                throw new DomainException('Especifica la organizacion seleccionada como "Otro".');
            }

            $organizaciones[] = new Organizaciones([
                'alum_organizacion_id' => $alumOrganizacion->id,
                'catalogo_organizaciones_id' => $catalogoId,
                'otra_organizacion_especificar' => $esOtro ? $otra : null,
            ]);
        }

        if (empty($organizaciones)) {
            throw new DomainException('Selecciona al menos una organizacion o indica que no participas en organizaciones.');
        }

        Organizaciones::deleteAll(['alum_organizacion_id' => $alumOrganizacion->id]);

        foreach ($organizaciones as $organizacion) {
            if (!$organizacion->save()) {
                throw new DomainException('Error al guardar organizaciones: ' . json_encode($organizacion->errors));
            }
        }
    }
}
