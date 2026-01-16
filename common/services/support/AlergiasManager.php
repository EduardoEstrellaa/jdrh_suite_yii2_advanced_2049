<?php

namespace common\services\support;

use DomainException;
use common\models\AlumAlergia;
use common\models\Alergias;
use common\models\VariasReaccionesAlergicas;

class AlergiasManager
{
    /**
     * Sincroniza las alergias y reacciones asociadas a un alumno.
     */
    public static function sync(AlumAlergia $alumAlergia, array $post): void
    {
        if ($alumAlergia->isNewRecord || !$alumAlergia->id) {
            throw new DomainException('No se pudo asociar alergias sin un registro base guardado.');
        }

        if ((int)$alumAlergia->padeces_alergias !== 1) {
            $alergiaIds = Alergias::find()
                ->select('id')
                ->where(['alum_alergia_id' => $alumAlergia->id])
                ->column();

            if (!empty($alergiaIds)) {
                VariasReaccionesAlergicas::deleteAll(['alergias_id' => $alergiaIds]);
            }

            Alergias::deleteAll(['alum_alergia_id' => $alumAlergia->id]);
            return;
        }

        $rows = $post['Alergias'] ?? [];
        $registros = [];

        foreach ($rows as $row) {
            $data = self::mapRowToData($alumAlergia->id, $row);
            if ($data !== null) {
                $registros[] = $data;
            }
        }

        if (empty($registros)) {
            throw new DomainException('Agrega al menos una alergia o indica que no las padeces.');
        }

        $alergiaIds = Alergias::find()
            ->select('id')
            ->where(['alum_alergia_id' => $alumAlergia->id])
            ->column();

        if (!empty($alergiaIds)) {
            VariasReaccionesAlergicas::deleteAll(['alergias_id' => $alergiaIds]);
        }
        Alergias::deleteAll(['alum_alergia_id' => $alumAlergia->id]);

        foreach ($registros as $registro) {
            /** @var Alergias $alergia */
            $alergia = $registro['alergia'];
            $reacciones = $registro['reacciones'];

            if (!$alergia->save()) {
                throw new DomainException('Error al guardar alergia: ' . json_encode($alergia->errors));
            }

            foreach ($reacciones as $reaccionId) {
                $reaccion = new VariasReaccionesAlergicas([
                    'alergias_id' => $alergia->id,
                    'catalogo_reacciones_alergicas_id' => $reaccionId,
                ]);

                if (!$reaccion->save()) {
                    throw new DomainException('Error al guardar reacciones de alergia: ' . json_encode($reaccion->errors));
                }
            }
        }
    }

    private static function mapRowToData(int $alumAlergiaId, array $row): ?array
    {
        $selected = isset($row['selected']) && (int)$row['selected'] === 1;
        if (!$selected) {
            return null;
        }

        $catalogoId = (int)($row['catalogo_alergias_id'] ?? 0);
        $gravedadId = (int)($row['tipo_gravedad_id'] ?? 0);
        $reacciones = array_values(array_filter(array_map('intval', $row['reacciones'] ?? []), static function ($id) {
            return $id > 0;
        }));

        if ($catalogoId <= 0) {
            throw new DomainException('Cada alergia marcada requiere un tipo de alergia.');
        }

        if ($gravedadId <= 0) {
            throw new DomainException('Selecciona la gravedad para cada alergia marcada.');
        }

        if (empty($reacciones)) {
            throw new DomainException('Selecciona al menos una reaccion para cada alergia.');
        }

        $alergia = new Alergias([
            'alum_alergia_id' => $alumAlergiaId,
            'catalogo_alergias_id' => $catalogoId,
            'tipo_gravedad_id' => $gravedadId,
        ]);

        return [
            'alergia' => $alergia,
            'reacciones' => $reacciones,
        ];
    }
}
