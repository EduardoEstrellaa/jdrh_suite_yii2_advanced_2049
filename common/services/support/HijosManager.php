<?php

namespace common\services\support;

use DomainException;
use common\models\AlumInfoHijos;
use common\models\EdadesHijos;
use common\services\HijosService;

class HijosManager
{
    /**
     * Sincroniza la información de hijos con base en el POST.
     */
    public static function sync(AlumInfoHijos $alumInfoHijos, array $post): void
    {
        $dataHijos = $post['EdadesHijos'] ?? [];

        if ((int)$alumInfoHijos->tiene_hijos === 1) {
            if (count($dataHijos) < 1) {
                throw new DomainException('Captura al menos un hijo.');
            }
            $alumInfoHijos->cantidad_hijos = count($dataHijos);
            $alumInfoHijos->save(false);
            HijosService::saveAll($alumInfoHijos->id, $post);
            return;
        }

        $alumInfoHijos->cantidad_hijos = 0;
        $alumInfoHijos->save(false);
        EdadesHijos::deleteAll(['alum_info_hijos_id' => $alumInfoHijos->id]);
    }
}
