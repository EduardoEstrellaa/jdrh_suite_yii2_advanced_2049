<?php

namespace common\services;

use Yii;
use common\models\DatosPersonales;
use common\models\LugaresNacimiento;
use common\models\DomiciliosActuales;
use common\models\DatosGenerales;
use yii\web\NotFoundHttpException;

class ExpedienteService
{
    /**
     * Crea un expediente completo dentro de una transacción.
     */
    public static function crearExpediente($perfil, $post)
    {
        $datosPersonales = new DatosPersonales(['perfil_id' => $perfil->id]);
        $lugaresNacimiento = new LugaresNacimiento(['perfil_id' => $perfil->id]);
        $domiciliosActuales = new DomiciliosActuales(['perfil_id' => $perfil->id]);
        $datosGenerales = new DatosGenerales(['perfil_id' => $perfil->id]);

        $models = [$datosPersonales, $lugaresNacimiento, $domiciliosActuales, $datosGenerales];

        foreach ($models as $model) {
            $model->load($post);
            if (!$model->validate()) {
                return false;
            }
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($models as $model) {
                $model->save(false);
            }
            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            return false;
        }
    }

    /**
     * Obtiene modelos nuevos para crear expediente
     */
    public static function getModelsForCreate($perfil_id)
    {
        return [
            'datosPersonales' => new DatosPersonales(['perfil_id' => $perfil_id]),
            'lugaresNacimiento' => new LugaresNacimiento(['perfil_id' => $perfil_id]),
            'domiciliosActuales' => new DomiciliosActuales(['perfil_id' => $perfil_id]),
            'datosGenerales' => new DatosGenerales(['perfil_id' => $perfil_id]),
        ];
    }

    /**
     * Obtiene los modelos para actualizar expediente
     */
    public static function getModelsForUpdate($perfil_id)
    {
        return [
            'datosPersonales' => self::findOrCreateModel(DatosPersonales::class, $perfil_id),
            'lugaresNacimiento' => self::findOrCreateModel(LugaresNacimiento::class, $perfil_id),
            'domiciliosActuales' => self::findOrCreateModel(DomiciliosActuales::class, $perfil_id),
            'datosGenerales' => self::findOrCreateModel(DatosGenerales::class, $perfil_id),
        ];
    }
    /**
     * Actualiza un expediente existente de forma transaccional.
     */
    public static function actualizarExpediente($perfilId, $post)
    {
        $datosPersonales = self::findOrCreateModel(DatosPersonales::class, $perfilId);
        $lugaresNacimiento = self::findOrCreateModel(LugaresNacimiento::class, $perfilId);
        $domiciliosActuales = self::findOrCreateModel(DomiciliosActuales::class, $perfilId);
        $datosGenerales = self::findOrCreateModel(DatosGenerales::class, $perfilId);

        $models = [$datosPersonales, $lugaresNacimiento, $domiciliosActuales, $datosGenerales];

        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($models as $model) {
                if ($model->load($post) && !$model->save()) {
                    Yii::error("Error en " . get_class($model) . " : " . json_encode($model->errors));
                    $transaction->rollBack();
                    return false;
                }
            }

            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            throw $e;
        }
    }


    /**
     * Busca o crea un modelo
     */
    private static function findOrCreateModel($className, $perfil_id)
    {
        $model = $className::find()->where(['perfil_id' => $perfil_id])->one();
        if (!$model) {
            $model = new $className();
            $model->perfil_id = $perfil_id;
        }
        return $model;
    }

    /**
     * Elimina un expediente completo de forma transaccional.
     */
    public static function eliminarExpediente($perfilId)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            DatosPersonales::deleteAll(['perfil_id' => $perfilId]);
            LugaresNacimiento::deleteAll(['perfil_id' => $perfilId]);
            DomiciliosActuales::deleteAll(['perfil_id' => $perfilId]);
            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            return false;
        }
    }
}
