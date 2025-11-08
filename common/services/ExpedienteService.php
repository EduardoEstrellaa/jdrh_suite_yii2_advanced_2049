<?php

namespace common\services;

use Yii;
use common\models\DatosPersonales;
use common\models\LugaresNacimiento;
use common\models\DomiciliosActuales;
use yii\web\NotFoundHttpException;

class ExpedienteService
{
    /**
     * Crea un expediente completo dentro de una transacción.
     */
    public static function crearExpediente($perfil, $post)
    {
        $datos = new DatosPersonales(['perfil_id' => $perfil->id]);
        $nacimiento = new LugaresNacimiento(['perfil_id' => $perfil->id]);
        $domicilio = new DomiciliosActuales(['perfil_id' => $perfil->id]);

        $datos->load($post);
        $nacimiento->load($post);
        $domicilio->load($post);

        $isValid = $datos->validate() && $nacimiento->validate() && $domicilio->validate();

        if (!$isValid) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $datos->save(false);
            $nacimiento->save(false);
            $domicilio->save(false);
            $transaction->commit();
            return $datos;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            return false;
        }
    }

    /**
     * Actualiza un expediente existente de forma transaccional.
     */
    public static function actualizarExpediente($perfil, $id, $post)
    {
        $datos = DatosPersonales::findOne($id);
        if (!$datos || $datos->perfil_id !== $perfil->id) {
            throw new NotFoundHttpException(Yii::t('app', 'Expediente no encontrado o sin permisos.'));
        }

        $nacimiento = LugaresNacimiento::findOne(['perfil_id' => $perfil->id]);
        $domicilio = DomiciliosActuales::findOne(['perfil_id' => $perfil->id]);

        $datos->load($post);
        $nacimiento->load($post);
        $domicilio->load($post);

        $isValid = $datos->validate() && $nacimiento->validate() && $domicilio->validate();

        if (!$isValid) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $datos->save(false);
            $nacimiento->save(false);
            $domicilio->save(false);
            $transaction->commit();
            return $datos;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            return false;
        }
    }
}
