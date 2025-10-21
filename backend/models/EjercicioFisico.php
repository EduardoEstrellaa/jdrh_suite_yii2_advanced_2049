<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ejercicio_fisico".
 *
 * @property int $id
 * @property int $alum_ejercicio_id
 * @property int $catalogo_actividad_ejercicio_id
 * @property int $frecuencia_veces_semana_id
 *
 * @property AlumEjercicio $alumEjercicio
 * @property CatalogoActividadEjercicio $catalogoActividadEjercicio
 * @property FrecuenciaVecesSemana $frecuenciaVecesSemana
 */
class EjercicioFisico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ejercicio_fisico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alum_ejercicio_id', 'catalogo_actividad_ejercicio_id', 'frecuencia_veces_semana_id'], 'required'],
            [['alum_ejercicio_id', 'catalogo_actividad_ejercicio_id', 'frecuencia_veces_semana_id'], 'integer'],
            [['alum_ejercicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumEjercicio::class, 'targetAttribute' => ['alum_ejercicio_id' => 'id']],
            [['catalogo_actividad_ejercicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoActividadEjercicio::class, 'targetAttribute' => ['catalogo_actividad_ejercicio_id' => 'id']],
            [['frecuencia_veces_semana_id'], 'exist', 'skipOnError' => true, 'targetClass' => FrecuenciaVecesSemana::class, 'targetAttribute' => ['frecuencia_veces_semana_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_ejercicio_id' => 'Alum Ejercicio ID',
            'catalogo_actividad_ejercicio_id' => 'Catalogo Actividad Ejercicio ID',
            'frecuencia_veces_semana_id' => 'Frecuencia Veces Semana ID',
        ];
    }

    /**
     * Gets query for [[AlumEjercicio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumEjercicio()
    {
        return $this->hasOne(AlumEjercicio::class, ['id' => 'alum_ejercicio_id']);
    }

    /**
     * Gets query for [[CatalogoActividadEjercicio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoActividadEjercicio()
    {
        return $this->hasOne(CatalogoActividadEjercicio::class, ['id' => 'catalogo_actividad_ejercicio_id']);
    }

    /**
     * Gets query for [[FrecuenciaVecesSemana]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrecuenciaVecesSemana()
    {
        return $this->hasOne(FrecuenciaVecesSemana::class, ['id' => 'frecuencia_veces_semana_id']);
    }
}
