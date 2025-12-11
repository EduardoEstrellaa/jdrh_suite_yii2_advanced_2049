<?php

namespace common\services;

use Yii;
use common\models\EdadesHijos;

class HijosService
{
    public static function saveAll($alumInfoHijosId, $post)
    {
        $data = $post['EdadesHijos'] ?? [];
        if (!$data) return;

        $idsEnviados = [];

        foreach ($data as $item) {

            // Validar campos requeridos
            foreach (['nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento'] as $campo) {
                if (empty(trim($item[$campo] ?? ''))) {
                    throw new \Exception("El campo '$campo' es requerido en datos de hijos.");
                }
            }

            // Si existe id → actualizar
            if (!empty($item['id'])) {
                $hijo = EdadesHijos::findOne([
                    'id' => $item['id'],
                    'alum_info_hijos_id' => $alumInfoHijosId
                ]);

                if (!$hijo) {
                    throw new \Exception("Intento de modificar hijo inexistente.");
                }
            } else {
                // Crear nuevo
                $hijo = new EdadesHijos();
                $hijo->alum_info_hijos_id = $alumInfoHijosId;
            }

            $hijo->setAttributes($item);

            if (!$hijo->save()) {
                throw new \Exception("Error guardando hijo: " . json_encode($hijo->errors));
            }

            $idsEnviados[] = $hijo->id;
        }

        // Eliminar hijos que ya no están
        EdadesHijos::deleteAll([
            'and',
            ['alum_info_hijos_id' => $alumInfoHijosId],
            ['not in', 'id', $idsEnviados]
        ]);
    }
}
