<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_asiste_medico".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $frecuencia_tiempo_id
 *
 * @property Alumnos $alumnos
 * @property FrecuenciaTiempo $frecuenciaTiempo
 */
class AlumAsisteMedico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_asiste_medico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'frecuencia_tiempo_id'], 'required'],
            [['alumnos_id', 'frecuencia_tiempo_id'], 'integer'],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['frecuencia_tiempo_id'], 'exist', 'skipOnError' => true, 'targetClass' => FrecuenciaTiempo::class, 'targetAttribute' => ['frecuencia_tiempo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alumnos_id' => 'Alumnos ID',
            'frecuencia_tiempo_id' => 'Frecuencia Tiempo ID',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasOne(Alumnos::class, ['id' => 'alumnos_id']);
    }

    /**
     * Gets query for [[FrecuenciaTiempo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrecuenciaTiempo()
    {
        return $this->hasOne(FrecuenciaTiempo::class, ['id' => 'frecuencia_tiempo_id']);
    }
}
