<?php

namespace common\services;

use DomainException;
use Yii;
use common\models\DatosPersonales;
use common\models\LugaresNacimiento;
use common\models\DomiciliosActuales;
use common\models\DatosGenerales;
use common\models\AlumBecas;
use common\models\AlumDatosFamiliares;
use common\models\AlumInfoHijos;
use common\models\AlumDependeEconomicamente;
use common\models\AlumDependenEconomica;
use common\models\Dependientes;
use common\models\EdadesHijos;
use common\models\CatalogoDependenciasEconomicas;
use common\models\AlumTrabajo;
use common\models\AlumVivienda;
use common\models\CatalogoBienesVivienda;
use common\models\TiposViviendas;
use common\models\ViviendaBienes;
use common\models\AlumBienesPersonales;
use common\services\support\DependientesManager;
use common\services\support\HijosManager;
use common\services\support\ViviendaBienesManager;
use common\services\support\AlumBienesPersonalesManager;

class ExpedienteService
{
    /**
     * Crea un expediente completo dentro de una transacción.
     */
    public static function crearExpediente($perfil, $alumno, $post)
    {
        $models = self::initializeModelsForCreate($perfil, $alumno);

        self::loadAndValidate($models, $post);
        self::normalizeModels($models);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            self::saveModels($models);
            HijosManager::sync($models['alumInfoHijos'], $post);
            DependientesManager::sync($models['alumDependenEconomica'], $post);
            ViviendaBienesManager::sync($models['alumVivienda'], $post);
            AlumBienesPersonalesManager::sync($alumno->id, $post);
            $transaction->commit();
            return true;
        } catch (DomainException $e) {
            $transaction->rollBack();
            Yii::warning($e->getMessage(), __METHOD__);
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            throw $e;
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
            self::loadModels($models, $post);
            self::normalizeModels($models);
            self::saveModels($models);
            HijosManager::sync($models['alumInfoHijos'], $post);
            DependientesManager::sync($models['alumDependenEconomica'], $post);
            ViviendaBienesManager::sync($models['alumVivienda'], $post);
            AlumBienesPersonalesManager::sync($alumnoId, $post);
            $transaction->commit();
            return true;
        } catch (DomainException $e) {
            $transaction->rollBack();
            Yii::warning($e->getMessage(), __METHOD__);
            throw $e;
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
        $models['alumDependeEconomicamente'] = new AlumDependeEconomicamente(['alumnos_id' => $alumno->id]);
        $models['alumDependenEconomica'] = new AlumDependenEconomica(['alumnos_id' => $alumno->id]);
        $models['alumTrabajo'] = new AlumTrabajo(['alumnos_id' => $alumno->id]);
        $models['alumVivienda'] = new AlumVivienda(['alumnos_id' => $alumno->id]);

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
        $models['alumDependeEconomicamente'] = self::findOrCreateModel(AlumDependeEconomicamente::class, ['alumnos_id' => $alumnoId]);
        $models['alumDependenEconomica'] = self::findOrCreateModel(AlumDependenEconomica::class, ['alumnos_id' => $alumnoId]);
        $models['alumTrabajo'] = self::findOrCreateModel(AlumTrabajo::class, ['alumnos_id' => $alumnoId]);
        $models['alumVivienda'] = self::findOrCreateModel(AlumVivienda::class, ['alumnos_id' => $alumnoId]);

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
     * Carga y valida múltiples modelos; lanza excepción si alguno falla.
     */
    private static function loadAndValidate(array $models, array $post): void
    {
        foreach ($models as $model) {
            if (!$model->load($post) || !$model->validate()) {
                throw new DomainException('Validación fallida en ' . get_class($model));
            }
        }
    }

    /**
     * Carga modelos sin validar; se usa en actualización para mantener datos previos.
     */
    private static function loadModels(array $models, array $post): void
    {
        foreach ($models as $model) {
            $model->load($post);
        }
    }

    /**
     * Guarda todos los modelos sin repetir transacciones.
     */
    private static function saveModels(array $models): void
    {
        foreach ($models as $model) {
            self::normalizeModel($model);
            if (!$model->save()) {
                Yii::error("Error en " . get_class($model) . " : " . json_encode($model->errors));
                throw new DomainException('No se pudo guardar ' . get_class($model));
            }
        }
    }

    /**
     * Normaliza los campos de beca cuando no corresponden.
     */
    private static function normalizeBecaFields(AlumBecas $alumBecas): void
    {
        if ((int)$alumBecas->tiene_beca !== 1) {
            $alumBecas->tipos_becas_id = null;
            $alumBecas->otro_especificar = null;
            return;
        }

        if ((int)$alumBecas->tipos_becas_id !== 1) {
            $alumBecas->otro_especificar = null;
        }
    }

    /**
     * Limpia campos de dependencia económica cuando no aplica "Otro".
     */
    private static function normalizeDependenciaFields(AlumDependeEconomicamente $alumDependeEconomicamente): void
    {
        $otroId = CatalogoDependenciasEconomicas::getOtroId();
        if ($otroId === null) {
            $alumDependeEconomicamente->otro_especificar = null;
            return;
        }

        if ((int)$alumDependeEconomicamente->catalogo_dependencias_economicas_id !== $otroId) {
            $alumDependeEconomicamente->otro_especificar = null;
        }
    }

    /**
     * Limpia campos de trabajo cuando no aplica.
     */
    private static function normalizeTrabajoFields(AlumTrabajo $alumTrabajo): void
    {
        if ((int)$alumTrabajo->tiene_trabajo !== 1) {
            $alumTrabajo->nombre_empresa = null;
            $alumTrabajo->puesto_ocupacion = null;
            $alumTrabajo->horario_entrada = null;
            $alumTrabajo->horario_salida = null;
        }
    }

    /**
     * Normaliza modelos dependientes (becas/dependencia económica) previo a guardar.
     *
     * @param array $models
     */
    private static function normalizeModels(array &$models): void
    {
        foreach ($models as $model) {
            self::normalizeModel($model);
        }
    }

    /**
     * Normaliza un modelo concreto si aplica reglas especiales.
     *
     * @param mixed $model
     */
    private static function normalizeModel($model): void
    {
        if ($model instanceof AlumBecas) {
            self::normalizeBecaFields($model);
        }

        if ($model instanceof AlumDependeEconomicamente) {
            self::normalizeDependenciaFields($model);
        }

        if ($model instanceof AlumTrabajo) {
            self::normalizeTrabajoFields($model);
        }

        if ($model instanceof AlumVivienda) {
            self::normalizeViviendaFields($model);
        }
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
            AlumDependeEconomicamente::deleteAll(['alumnos_id' => $alumnoId]);
            AlumTrabajo::deleteAll(['alumnos_id' => $alumnoId]);
            AlumBienesPersonales::deleteAll(['alumnos_id' => $alumnoId]);
            $alumDependen = AlumDependenEconomica::findOne(['alumnos_id' => $alumnoId]);
            if ($alumDependen) {
                Dependientes::deleteAll(['alum_dependen_economica_id' => $alumDependen->id]);
                $alumDependen->delete();
            }
            $alumVivienda = AlumVivienda::findOne(['alumnos_id' => $alumnoId]);
            if ($alumVivienda) {
                ViviendaBienes::deleteAll(['alum_vivienda_id' => $alumVivienda->id]);
                $alumVivienda->delete();
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
     * Verifica si el expediente existe
     */
    public static function expedienteExiste($perfilId, $alumnoId)
    {
        $models = self::getModelsForUpdate($perfilId, $alumnoId);

        foreach ($models as $model) {
            if ($model instanceof AlumTrabajo) {
                continue;
            }
            if ($model instanceof AlumVivienda) {
                continue;
            }
            if ($model->isNewRecord) {
                return false;
            }
        }

        return true;
    }

    /**
     * Limpia campos de vivienda cuando no corresponden.
     */
    private static function normalizeViviendaFields(AlumVivienda $alumVivienda): void
    {
        if ((int)$alumVivienda->vives_casa_padres === 1) {
            $alumVivienda->otro_especificar = null;
        }

        $otroId = TiposViviendas::getOtroId();
        if ($otroId === null || (int)$alumVivienda->tipos_viviendas_id !== $otroId) {
            $alumVivienda->otro_tipo_especificar = null;
        }
    }
}
