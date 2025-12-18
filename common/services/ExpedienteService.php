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
        $datosPersonales = new DatosPersonales(['perfil_id' => $perfil->id]);
        $lugaresNacimiento = new LugaresNacimiento(['perfil_id' => $perfil->id]);
        $domiciliosActuales = new DomiciliosActuales(['perfil_id' => $perfil->id]);

        $datosPersonales->load($post);
        $lugaresNacimiento->load($post);
        $domiciliosActuales->load($post);

        if (!$datosPersonales->validate() || !$lugaresNacimiento->validate() || !$domiciliosActuales->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $datosPersonales->save(false);
            $lugaresNacimiento->save(false);
            $domiciliosActuales->save(false);
            $transaction->commit();
            return $datosPersonales;
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
        ];
    }

    /**
     * Actualiza un expediente existente de forma transaccional.
     */
    public static function actualizarExpediente($perfilId, $post)
    {
        // Buscar o crear modelos
        $datosPersonales = self::findOrCreateModel(DatosPersonales::class, $perfilId);
        $lugaresNacimiento = self::findOrCreateModel(LugaresNacimiento::class, $perfilId);
        $domiciliosActuales = self::findOrCreateModel(DomiciliosActuales::class, $perfilId);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $success = true;

            // Cargar y guardar cada modelo
            if ($datosPersonales->load($post)) {
                if (!$datosPersonales->save()) {
                    $success = false;
                    Yii::error('Error al guardar datos personales: ' . json_encode($datosPersonales->errors));
                }
            }

            if ($lugaresNacimiento->load($post)) {
                if (!$lugaresNacimiento->save()) {
                    $success = false;
                    Yii::error('Error al guardar lugar de nacimiento: ' . json_encode($lugaresNacimiento->errors));
                }
            }

            if ($domiciliosActuales->load($post)) {
                if (!$domiciliosActuales->save()) {
                    $success = false;
                    Yii::error('Error al guardar domicilio actual: ' . json_encode($domiciliosActuales->errors));
                }
            }

            if ($success) {
                $transaction->commit();
                return true;
            } else {
                $transaction->rollBack();
                return false;
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error('Error al actualizar expediente: ' . $e->getMessage());
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
