<?php

namespace common\services\support;

use DomainException;
use common\models\AlumDependenEconomica;
use common\models\CatalogoDependenciasEconomicas;
use common\models\Dependientes;

class DependientesManager
{
    /**
     * Sincroniza dependientes económicos según el POST.
     */
    public static function sync(AlumDependenEconomica $alumDependenEconomica, array $post): void
    {
        $dataDependientes = $post['Dependientes']['ids'] ?? [];
        $otroTexto = isset($post['Dependientes']['otro_especificar'])
            ? trim((string)$post['Dependientes']['otro_especificar'])
            : null;

        if ((int)$alumDependenEconomica->tiene_dependientes === 1) {
            if (count($dataDependientes) < 1) {
                throw new DomainException('Captura al menos un dependiente.');
            }
            $alumDependenEconomica->save(false);

            Dependientes::deleteAll(['alum_dependen_economica_id' => $alumDependenEconomica->id]);

            $otroId = CatalogoDependenciasEconomicas::getOtroId();
            foreach ($dataDependientes as $depId) {
                $depId = (int)$depId;
                if ($depId <= 0) {
                    continue;
                }

                $dependiente = new Dependientes([
                    'alum_dependen_economica_id' => $alumDependenEconomica->id,
                    'catalogo_dependencias_economicas_id' => $depId,
                ]);

                if ($otroId !== null && $depId === $otroId) {
                    if ($otroTexto === null || $otroTexto === '') {
                        throw new DomainException('Debes especificar el texto para "Otro" en dependientes.');
                    }
                    $dependiente->otro_especificar = $otroTexto;
                }

                if (!$dependiente->save()) {
                    throw new DomainException('Error al guardar dependiente: ' . json_encode($dependiente->errors));
                }
            }
            return;
        }

        $alumDependenEconomica->save(false);
        Dependientes::deleteAll(['alum_dependen_economica_id' => $alumDependenEconomica->id]);
    }
}
