<?php

namespace common\services;

use Yii;
use common\models\DatosPersonales;
use common\models\LugaresNacimiento;
use common\models\DomiciliosActuales;
use common\models\DatosGenerales;
use common\models\AlumBecas;
use common\models\AlumDatosFamiliares;
use common\models\AlumInfoHijos;
use common\models\EdadesHijos;
use yii\web\NotFoundHttpException;

class ExpedienteService
{
    // Definir todos los modelos que componen el expediente
    private static $modelClasses = [
        'datosPersonales' => DatosPersonales::class,
        'lugaresNacimiento' => LugaresNacimiento::class,
        'domiciliosActuales' => DomiciliosActuales::class,
        'datosGenerales' => DatosGenerales::class,
        'alumBecas' => AlumBecas::class,
        'alumDatosFamiliares' => AlumDatosFamiliares::class,
        'alumInfoHijos' => AlumInfoHijos::class,      // NUEVO
    ];

    /**
     * Crea un expediente completo dentro de una transacción.
     */
    public static function crearExpediente($perfil, $alumno, $post)
    {
        $models = self::initializeModelsForCreate($perfil, $alumno);

        foreach ($models as $model) {
            if (!$model->load($post) || !$model->validate()) {
                return false;
            }
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {

            foreach ($models as $model) {
                $model->save(false);
            }

            if ($models['alumInfoHijos']->tiene_hijos == 1) {
                HijosService::saveAll($models['alumInfoHijos']->id, $post);
            }

            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage());
            return false;
        }
    }


    /**
     * Actualiza un expediente existente de forma transaccional.
     */
    public static function actualizarExpediente($perfilId, $alumnoId, $post)
    {
        $models = self::getModelsForUpdate($perfilId, $alumnoId);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($models as $model) {
                if ($model->load($post) && !$model->save()) {
                    Yii::error("Error en " . get_class($model) . " : " . json_encode($model->errors));
                    $transaction->rollBack();
                    return false;
                }
            }

            if ($models['alumInfoHijos']->tiene_hijos == 1) {
                HijosService::saveAll($models['alumInfoHijos']->id, $post);
            } else {
                EdadesHijos::deleteAll(['alum_info_hijos_id' => $models['alumInfoHijos']->id]);
                $models['alumInfoHijos']->cantidad_hijos = 0;
                $models['alumInfoHijos']->save(false);
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
     * Obtiene modelos nuevos para crear expediente
     */
    public static function getModelsForCreate($perfil, $alumno)
    {
        $models = [];

        // Modelos con perfil_id
        $models['datosPersonales'] = new DatosPersonales(['perfil_id' => $perfil->id]);
        $models['lugaresNacimiento'] = new LugaresNacimiento(['perfil_id' => $perfil->id]);
        $models['domiciliosActuales'] = new DomiciliosActuales(['perfil_id' => $perfil->id]);
        $models['datosGenerales'] = new DatosGenerales(['perfil_id' => $perfil->id]);

        // Modelos con alumnos_id
        $models['alumBecas'] = new AlumBecas(['alumnos_id' => $alumno->id]);
        $models['alumDatosFamiliares'] = new AlumDatosFamiliares(['alumnos_id' => $alumno->id]);
        $models['alumInfoHijos'] = new AlumInfoHijos(['alumnos_id' => $alumno->id]);


        return $models;
    }

    /**
     * Obtiene los modelos para actualizar expediente
     */
    public static function getModelsForUpdate($perfilId, $alumnoId)
    {
        $models = [];

        // Modelos con perfil_id
        $models['datosPersonales'] = self::findOrCreateModel(DatosPersonales::class, ['perfil_id' => $perfilId]);
        $models['lugaresNacimiento'] = self::findOrCreateModel(LugaresNacimiento::class, ['perfil_id' => $perfilId]);
        $models['domiciliosActuales'] = self::findOrCreateModel(DomiciliosActuales::class, ['perfil_id' => $perfilId]);
        $models['datosGenerales'] = self::findOrCreateModel(DatosGenerales::class, ['perfil_id' => $perfilId]);

        // Modelos con alumnos_id
        $models['alumBecas'] = self::findOrCreateModel(AlumBecas::class, ['alumnos_id' => $alumnoId]);
        $models['alumDatosFamiliares'] = self::findOrCreateModel(AlumDatosFamiliares::class, ['alumnos_id' => $alumnoId]);
        $models['alumInfoHijos'] = self::findOrCreateModel(AlumInfoHijos::class, ['alumnos_id' => $alumnoId]);

        return $models;
    }

    /**
     * Inicializa modelos para creación
     */
    private static function initializeModelsForCreate($perfil, $alumno)
    {
        return self::getModelsForCreate($perfil, $alumno);
    }

    /**
     * Busca o crea un modelo
     */
    private static function findOrCreateModel($className, $conditions)
    {
        $model = $className::find()->where($conditions)->one();
        if (!$model) {
            $model = new $className();
            foreach ($conditions as $key => $value) {
                $model->$key = $value;
            }
        }
        return $model;
    }

    /**
     * Elimina un expediente completo de forma transaccional.
     */
    public static function eliminarExpediente($perfilId, $alumnoId)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            // Eliminar modelos con perfil_id
            DatosPersonales::deleteAll(['perfil_id' => $perfilId]);
            LugaresNacimiento::deleteAll(['perfil_id' => $perfilId]);
            DomiciliosActuales::deleteAll(['perfil_id' => $perfilId]);
            DatosGenerales::deleteAll(['perfil_id' => $perfilId]);

            // Eliminar modelos con alumnos_id
            AlumBecas::deleteAll(['alumnos_id' => $alumnoId]);
            AlumDatosFamiliares::deleteAll(['alumnos_id' => $alumnoId]);

            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            return false;
        }
    }

    /**
     * Verifica si el expediente existe
     */
    public static function expedienteExiste($perfilId, $alumnoId)
    {
        $models = self::getModelsForUpdate($perfilId, $alumnoId);

        foreach ($models as $model) {
            if ($model->isNewRecord) {
                return false;
            }
        }

        return true;
    }
}
