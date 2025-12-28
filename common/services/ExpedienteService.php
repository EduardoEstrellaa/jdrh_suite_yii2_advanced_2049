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
use common\models\AlumEstadoSalud;
use common\models\AlumEnfermedadesCronicas;
use common\models\AlumAlergia;
use common\models\ProblemasSalud;
use common\models\AlumServiciosSalud;
use common\models\ServiciosSalud;
use common\models\AlumAsisteMedico;
use common\models\AlumAsisteDentista;
use common\models\AlumUsoAnteojos;
use common\models\UsoAnteojos;
use common\models\AlumTratamientos;
use common\models\Tratamientos;
use common\models\AlumRecreacionTiempo;
use common\models\UsosInternet;
use common\models\AlumOrganizacion;
use common\models\Organizaciones;
use common\models\CatalogoCigarrosDia;
use common\models\FrecuenciaVecesSemana;
use common\models\AlumHabitosConsumo;
use common\models\AlumConsumoAlimentos;
use common\models\AlumLugaresComer;
use common\models\EnfermedadesCronicas;
use common\models\Alergias;
use common\models\VariasReaccionesAlergicas;
use common\models\CatalogoDependenciasEconomicas;
use common\models\AlumTrabajo;
use common\models\AlumTransportes;
use common\models\AlumVivienda;
use common\models\CatalogoBienesVivienda;
use common\models\TiposViviendas;
use common\models\ViviendaBienes;
use common\models\ViviendaServicios;
use common\models\AlumBienesPersonales;
use common\models\AlumDeportes;
use common\models\AlumEjercicio;
use common\models\Deportes;
use common\models\EjercicioFisico;
use common\services\support\DependientesManager;
use common\services\support\HijosManager;
use common\services\support\ViviendaBienesManager;
use common\services\support\AlumBienesPersonalesManager;
use common\services\support\ViviendaServiciosManager;
use common\services\support\ProblemasSaludManager;
use common\services\support\ServiciosSaludManager;
use common\services\support\UsoAnteojosManager;
use common\services\support\TratamientosManager;
use common\services\support\AlergiasManager;
use common\services\support\EnfermedadesCronicasManager;
use common\services\support\LugaresComerManager;
use common\services\support\ConsumoAlimentosManager;
use common\services\support\DeportesManager;
use common\services\support\EjercicioFisicoManager;
use common\services\support\RecreacionTiempoManager;
use common\services\support\OrganizacionesManager;

class ExpedienteService
{
    /**
     * Crea un expediente completo dentro de una transacción.
     */
    public static function crearExpediente($perfil, $alumno, $post)
    {
        $models = self::getModelsForCreate($perfil, $alumno);

        self::loadAndValidate($models, $post);
        self::normalizeModels($models);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            self::saveModels($models);
            self::syncAggregates($models, $post, $alumno->id);
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

        self::loadModels($models, $post);
        self::normalizeModels($models);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            self::saveModels($models);
            self::syncAggregates($models, $post, $alumnoId);
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
     * Obtiene modelos nuevos para crear expediente.
     */
    public static function getModelsForCreate($perfil, $alumno)
    {
        return [
            'alumHabitosConsumo' => new AlumHabitosConsumo([
                'alumnos_id' => $alumno->id,
                'catalogo_cigarros_dia_id' => self::getDefaultCatalogoId(CatalogoCigarrosDia::class),
                'frecuencia_veces_semana_id' => self::getDefaultCatalogoId(FrecuenciaVecesSemana::class),
            ]),
            'datosPersonales' => new DatosPersonales(['perfil_id' => $perfil->id]),
            'lugaresNacimiento' => new LugaresNacimiento(['perfil_id' => $perfil->id]),
            'domiciliosActuales' => new DomiciliosActuales(['perfil_id' => $perfil->id]),
            'datosGenerales' => new DatosGenerales(['perfil_id' => $perfil->id]),
            'alumBecas' => new AlumBecas(['alumnos_id' => $alumno->id]),
            'alumDatosFamiliares' => new AlumDatosFamiliares(['alumnos_id' => $alumno->id]),
            'alumInfoHijos' => new AlumInfoHijos(['alumnos_id' => $alumno->id]),
            'alumDependeEconomicamente' => new AlumDependeEconomicamente(['alumnos_id' => $alumno->id]),
            'alumDependenEconomica' => new AlumDependenEconomica(['alumnos_id' => $alumno->id]),
            'alumTrabajo' => new AlumTrabajo(['alumnos_id' => $alumno->id]),
            'alumVivienda' => new AlumVivienda(['alumnos_id' => $alumno->id]),
            'alumTransportes' => new AlumTransportes(['alumnos_id' => $alumno->id]),
            'alumDeportes' => new AlumDeportes(['alumnos_id' => $alumno->id]),
            'alumEjercicio' => new AlumEjercicio(['alumnos_id' => $alumno->id]),
            'alumEstadoSalud' => new AlumEstadoSalud(['alumnos_id' => $alumno->id]),
            'alumServiciosSalud' => new AlumServiciosSalud(['alumnos_id' => $alumno->id]),
            'alumAsisteMedico' => new AlumAsisteMedico(['alumnos_id' => $alumno->id]),
            'alumAsisteDentista' => new AlumAsisteDentista(['alumnos_id' => $alumno->id]),
            'alumUsoAnteojos' => new AlumUsoAnteojos(['alumnos_id' => $alumno->id]),
            'alumTratamientos' => new AlumTratamientos(['alumnos_id' => $alumno->id]),
            'alumEnfermedadesCronicas' => new AlumEnfermedadesCronicas(['alumnos_id' => $alumno->id]),
            'alumAlergia' => new AlumAlergia(['alumnos_id' => $alumno->id]),
            'alumRecreacionTiempo' => new AlumRecreacionTiempo(['alumnos_id' => $alumno->id]),
            'alumOrganizacion' => new AlumOrganizacion(['alumnos_id' => $alumno->id]),
        ];
    }

    /**
     * Obtiene los modelos para actualizar expediente.
     */
    public static function getModelsForUpdate($perfilId, $alumnoId)
    {
        return [
            'datosPersonales' => self::findOrCreateModel(DatosPersonales::class, ['perfil_id' => $perfilId]),
            'lugaresNacimiento' => self::findOrCreateModel(LugaresNacimiento::class, ['perfil_id' => $perfilId]),
            'domiciliosActuales' => self::findOrCreateModel(DomiciliosActuales::class, ['perfil_id' => $perfilId]),
            'datosGenerales' => self::findOrCreateModel(DatosGenerales::class, ['perfil_id' => $perfilId]),
            'alumBecas' => self::findOrCreateModel(AlumBecas::class, ['alumnos_id' => $alumnoId]),
            'alumDatosFamiliares' => self::findOrCreateModel(AlumDatosFamiliares::class, ['alumnos_id' => $alumnoId]),
            'alumInfoHijos' => self::findOrCreateModel(AlumInfoHijos::class, ['alumnos_id' => $alumnoId]),
            'alumDependeEconomicamente' => self::findOrCreateModel(AlumDependeEconomicamente::class, ['alumnos_id' => $alumnoId]),
            'alumDependenEconomica' => self::findOrCreateModel(AlumDependenEconomica::class, ['alumnos_id' => $alumnoId]),
            'alumTrabajo' => self::findOrCreateModel(AlumTrabajo::class, ['alumnos_id' => $alumnoId]),
            'alumVivienda' => self::findOrCreateModel(AlumVivienda::class, ['alumnos_id' => $alumnoId]),
            'alumTransportes' => self::findOrCreateModel(AlumTransportes::class, ['alumnos_id' => $alumnoId]),
            'alumDeportes' => self::findOrCreateModel(AlumDeportes::class, ['alumnos_id' => $alumnoId]),
            'alumEjercicio' => self::findOrCreateModel(AlumEjercicio::class, ['alumnos_id' => $alumnoId]),
            'alumHabitosConsumo' => self::findOrCreateHabitosConsumo($alumnoId),
            'alumEstadoSalud' => self::findOrCreateModel(AlumEstadoSalud::class, ['alumnos_id' => $alumnoId]),
            'alumServiciosSalud' => self::findOrCreateModel(AlumServiciosSalud::class, ['alumnos_id' => $alumnoId]),
            'alumAsisteMedico' => self::findOrCreateModel(AlumAsisteMedico::class, ['alumnos_id' => $alumnoId]),
            'alumAsisteDentista' => self::findOrCreateModel(AlumAsisteDentista::class, ['alumnos_id' => $alumnoId]),
            'alumUsoAnteojos' => self::findOrCreateModel(AlumUsoAnteojos::class, ['alumnos_id' => $alumnoId]),
            'alumTratamientos' => self::findOrCreateModel(AlumTratamientos::class, ['alumnos_id' => $alumnoId]),
            'alumEnfermedadesCronicas' => self::findOrCreateModel(AlumEnfermedadesCronicas::class, ['alumnos_id' => $alumnoId]),
            'alumAlergia' => self::findOrCreateModel(AlumAlergia::class, ['alumnos_id' => $alumnoId]),
            'alumRecreacionTiempo' => self::findOrCreateModel(AlumRecreacionTiempo::class, ['alumnos_id' => $alumnoId]),
            'alumOrganizacion' => self::findOrCreateModel(AlumOrganizacion::class, ['alumnos_id' => $alumnoId]),
        ];
    }

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

    private static function findOrCreateHabitosConsumo(int $alumnoId): AlumHabitosConsumo
    {
        $model = AlumHabitosConsumo::find()->where(['alumnos_id' => $alumnoId])->one();
        if ($model) {
            return $model;
        }

        $model = new AlumHabitosConsumo([
            'alumnos_id' => $alumnoId,
            'catalogo_cigarros_dia_id' => self::getDefaultCatalogoId(CatalogoCigarrosDia::class),
            'frecuencia_veces_semana_id' => self::getDefaultCatalogoId(FrecuenciaVecesSemana::class),
        ]);

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
            if (!$model->save()) {
                Yii::error('Error en ' . get_class($model) . ' : ' . json_encode($model->errors));
                throw new DomainException('No se pudo guardar ' . get_class($model));
            }
        }
    }

    private static function normalizeModels(array &$models): void
    {
        foreach ($models as $model) {
            self::normalizeModel($model);
        }
    }

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

        if ($model instanceof AlumHabitosConsumo) {
            self::normalizeHabitosConsumoFields($model);
        }

        if ($model instanceof AlumRecreacionTiempo) {
            self::normalizeRecreacionFields($model);
        }
    }

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

    private static function normalizeTrabajoFields(AlumTrabajo $alumTrabajo): void
    {
        if ((int)$alumTrabajo->tiene_trabajo !== 1) {
            $alumTrabajo->nombre_empresa = null;
            $alumTrabajo->puesto_ocupacion = null;
            $alumTrabajo->horario_entrada = null;
            $alumTrabajo->horario_salida = null;
        }
    }

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

    private static function normalizeHabitosConsumoFields(AlumHabitosConsumo $alumHabitosConsumo): void
    {
        $defaultCigarrosId = self::getDefaultCatalogoId(CatalogoCigarrosDia::class);
        $defaultFrecuenciaId = self::getDefaultCatalogoId(FrecuenciaVecesSemana::class);

        if ((int)$alumHabitosConsumo->fumas === 1) {
            if ($alumHabitosConsumo->catalogo_cigarros_dia_id === null) {
                $alumHabitosConsumo->catalogo_cigarros_dia_id = $defaultCigarrosId;
            }
        } else {
            $alumHabitosConsumo->catalogo_cigarros_dia_id = self::getDefaultCatalogoId(CatalogoCigarrosDia::class);
        }

        if ((int)$alumHabitosConsumo->tomas_alcohol === 1) {
            if ($alumHabitosConsumo->frecuencia_veces_semana_id === null) {
                $alumHabitosConsumo->frecuencia_veces_semana_id = $defaultFrecuenciaId;
            }
        } else {
            $alumHabitosConsumo->frecuencia_veces_semana_id = $defaultFrecuenciaId;
        }

        if ((int)$alumHabitosConsumo->tienes_adicciones !== 1) {
            $alumHabitosConsumo->especificiar_adiccion = null;
        } else {
            $alumHabitosConsumo->especificiar_adiccion = trim((string)$alumHabitosConsumo->especificiar_adiccion) ?: null;
        }
    }

    private static function normalizeRecreacionFields(AlumRecreacionTiempo $alumRecreacionTiempo): void
    {
        if ((int)$alumRecreacionTiempo->tienes_acceso_internet !== 1) {
            $alumRecreacionTiempo->catalogo_lugares_acceso_principal_id = null;
        }
    }

    private static function getDefaultCatalogoId(string $className): ?int
    {
        /** @var \yii\db\ActiveRecord $className */
        $id = $className::find()
            ->select('id')
            ->orderBy(['id' => SORT_ASC])
            ->scalar();

        return $id !== false ? (int)$id : 1;
    }

    /**
     * Sincroniza colecciones relacionadas después de guardar los modelos base.
     */
    private static function syncAggregates(array $models, array $post, int $alumnoId): void
    {
        DeportesManager::sync($models['alumDeportes'], $post);
        EjercicioFisicoManager::sync($models['alumEjercicio'], $post);
        ProblemasSaludManager::sync($models['alumEstadoSalud'], $post);
        ServiciosSaludManager::sync($models['alumServiciosSalud'], $post);
        UsoAnteojosManager::sync($models['alumUsoAnteojos'], $post);
        TratamientosManager::sync($models['alumTratamientos'], $post);
        EnfermedadesCronicasManager::sync($models['alumEnfermedadesCronicas'], $post);
        AlergiasManager::sync($models['alumAlergia'], $post);
        LugaresComerManager::sync($alumnoId, $post);
        ConsumoAlimentosManager::sync($alumnoId, $post);
        HijosManager::sync($models['alumInfoHijos'], $post);
        DependientesManager::sync($models['alumDependenEconomica'], $post);
        ViviendaBienesManager::sync($models['alumVivienda'], $post);
        ViviendaServiciosManager::sync($models['alumVivienda'], $post);
        AlumBienesPersonalesManager::sync($alumnoId, $post);
        RecreacionTiempoManager::sync($models['alumRecreacionTiempo'], $post);
        OrganizacionesManager::sync($models['alumOrganizacion'], $post);
    }

    /**
     * Elimina un expediente completo de forma transaccional.
     */
    public static function eliminarExpediente($perfilId, $alumnoId)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            DatosPersonales::deleteAll(['perfil_id' => $perfilId]);
            LugaresNacimiento::deleteAll(['perfil_id' => $perfilId]);
            DomiciliosActuales::deleteAll(['perfil_id' => $perfilId]);
            DatosGenerales::deleteAll(['perfil_id' => $perfilId]);

            AlumBecas::deleteAll(['alumnos_id' => $alumnoId]);
            AlumDatosFamiliares::deleteAll(['alumnos_id' => $alumnoId]);
            AlumDependeEconomicamente::deleteAll(['alumnos_id' => $alumnoId]);
            AlumTrabajo::deleteAll(['alumnos_id' => $alumnoId]);
            AlumBienesPersonales::deleteAll(['alumnos_id' => $alumnoId]);
            AlumTransportes::deleteAll(['alumnos_id' => $alumnoId]);
            AlumLugaresComer::deleteAll(['alumnos_id' => $alumnoId]);
            AlumConsumoAlimentos::deleteAll(['alumnos_id' => $alumnoId]);
            AlumHabitosConsumo::deleteAll(['alumnos_id' => $alumnoId]);
            $alumDeportes = AlumDeportes::findOne(['alumnos_id' => $alumnoId]);
            if ($alumDeportes) {
                Deportes::deleteAll(['alum_deportes_id' => $alumDeportes->id]);
                $alumDeportes->delete();
            }
            $alumEjercicio = AlumEjercicio::findOne(['alumnos_id' => $alumnoId]);
            if ($alumEjercicio) {
                EjercicioFisico::deleteAll(['alum_ejercicio_id' => $alumEjercicio->id]);
                $alumEjercicio->delete();
            }

            AlumAsisteMedico::deleteAll(['alumnos_id' => $alumnoId]);
            AlumAsisteDentista::deleteAll(['alumnos_id' => $alumnoId]);
            $alumEstadoSalud = AlumEstadoSalud::findOne(['alumnos_id' => $alumnoId]);
            if ($alumEstadoSalud) {
                ProblemasSalud::deleteAll(['alum_estado_salud_id' => $alumEstadoSalud->id]);
                $alumEstadoSalud->delete();
            }
            $alumUsoAnteojos = AlumUsoAnteojos::findOne(['alumnos_id' => $alumnoId]);
            if ($alumUsoAnteojos) {
                UsoAnteojos::deleteAll(['alum_uso_anteojos_id' => $alumUsoAnteojos->id]);
                $alumUsoAnteojos->delete();
            }
            $alumServiciosSalud = AlumServiciosSalud::findOne(['alumnos_id' => $alumnoId]);
            if ($alumServiciosSalud) {
                ServiciosSalud::deleteAll(['alum_servicios_salud_id' => $alumServiciosSalud->id]);
                $alumServiciosSalud->delete();
            }
            $alumTratamientos = AlumTratamientos::findOne(['alumnos_id' => $alumnoId]);
            if ($alumTratamientos) {
                Tratamientos::deleteAll(['alum_tratamientos_id' => $alumTratamientos->id]);
                $alumTratamientos->delete();
            }
            $alumEnfermedadesCronicas = AlumEnfermedadesCronicas::findOne(['alumnos_id' => $alumnoId]);
            if ($alumEnfermedadesCronicas) {
                EnfermedadesCronicas::deleteAll(['alum_enfermedades_cronicas_id' => $alumEnfermedadesCronicas->id]);
                $alumEnfermedadesCronicas->delete();
            }
            $alumAlergia = AlumAlergia::findOne(['alumnos_id' => $alumnoId]);
            if ($alumAlergia) {
                $alergiaIds = Alergias::find()
                    ->select('id')
                    ->where(['alum_alergia_id' => $alumAlergia->id])
                    ->column();
                if (!empty($alergiaIds)) {
                    VariasReaccionesAlergicas::deleteAll(['alergias_id' => $alergiaIds]);
                }
                Alergias::deleteAll(['alum_alergia_id' => $alumAlergia->id]);
                $alumAlergia->delete();
            }
            $alumDependen = AlumDependenEconomica::findOne(['alumnos_id' => $alumnoId]);
            if ($alumDependen) {
                Dependientes::deleteAll(['alum_dependen_economica_id' => $alumDependen->id]);
                $alumDependen->delete();
            }
            $alumRecreacionTiempo = AlumRecreacionTiempo::findOne(['alumnos_id' => $alumnoId]);
            if ($alumRecreacionTiempo) {
                UsosInternet::deleteAll(['alum_recreacion_tiempo_id' => $alumRecreacionTiempo->id]);
                $alumRecreacionTiempo->delete();
            }
            $alumOrganizacion = AlumOrganizacion::findOne(['alumnos_id' => $alumnoId]);
            if ($alumOrganizacion) {
                Organizaciones::deleteAll(['alum_organizacion_id' => $alumOrganizacion->id]);
                $alumOrganizacion->delete();
            }
            $alumVivienda = AlumVivienda::findOne(['alumnos_id' => $alumnoId]);
            if ($alumVivienda) {
                ViviendaBienes::deleteAll(['alum_vivienda_id' => $alumVivienda->id]);
                ViviendaServicios::deleteAll(['alum_vivienda_id' => $alumVivienda->id]);
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
     * Verifica si el expediente existe.
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
            if ($model instanceof AlumTransportes) {
                continue;
            }
            if ($model instanceof AlumServiciosSalud) {
                continue;
            }
            if ($model instanceof AlumAsisteMedico) {
                continue;
            }
            if ($model instanceof AlumAsisteDentista) {
                continue;
            }
            if ($model instanceof AlumUsoAnteojos) {
                continue;
            }
            if ($model instanceof AlumTratamientos) {
                continue;
            }
            if ($model instanceof AlumEnfermedadesCronicas) {
                continue;
            }
            if ($model instanceof AlumAlergia) {
                continue;
            }
            if ($model instanceof AlumDeportes) {
                continue;
            }
            if ($model instanceof AlumEjercicio) {
                continue;
            }
            if ($model instanceof AlumHabitosConsumo) {
                continue;
            }
            if ($model instanceof AlumRecreacionTiempo) {
                continue;
            }
            if ($model instanceof AlumOrganizacion) {
                continue;
            }
            if ($model->isNewRecord) {
                return false;
            }
        }

        return true;
    }
}
