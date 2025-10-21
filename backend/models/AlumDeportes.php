<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_deportes".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $practicas_algun_deporte
 *
 * @property Alumnos $alumnos
 * @property Deportes[] $deportes
 */
class AlumDeportes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_deportes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'practicas_algun_deporte'], 'required'],
            [['alumnos_id', 'practicas_algun_deporte'], 'integer'],
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
            'practicas_algun_deporte' => 'Practicas Algun Deporte',
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
     * Gets query for [[Deportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeportes()
    {
        return $this->hasMany(Deportes::class, ['alum_deportes_id' => 'id']);
    }
}
