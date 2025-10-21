<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_organizacion".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $participas_organizacion
 *
 * @property Alumnos $alumnos
 * @property Organizaciones[] $organizaciones
 */
class AlumOrganizacion extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_organizacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'participas_organizacion'], 'required'],
            [['alumnos_id', 'participas_organizacion'], 'integer'],
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
            'participas_organizacion' => 'Participas Organizacion',
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
     * Gets query for [[Organizaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizaciones()
    {
        return $this->hasMany(Organizaciones::class, ['alum_organizacion_id' => 'id']);
    }

}
