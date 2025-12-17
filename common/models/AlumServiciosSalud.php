<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alum_servicios_salud".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $tiene_servicios_salud
 *
 * @property Alumnos $alumnos
 * @property ServiciosSalud[] $serviciosSaluds
 */
class AlumServiciosSalud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_servicios_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'tiene_servicios_salud'], 'required'],
            [['alumnos_id', 'tiene_servicios_salud'], 'integer'],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
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
            'tiene_servicios_salud' => 'Tiene Servicios Salud',
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
     * Gets query for [[ServiciosSaluds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiciosSaluds()
    {
        return $this->hasMany(ServiciosSalud::class, ['alum_servicios_salud_id' => 'id']);
    }
}
