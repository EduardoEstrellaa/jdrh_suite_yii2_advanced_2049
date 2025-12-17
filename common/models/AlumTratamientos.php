<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alum_tratamientos".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $esta_en_tratamiento
 *
 * @property Alumnos $alumnos
 * @property Tratamientos[] $tratamientos
 */
class AlumTratamientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_tratamientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'esta_en_tratamiento'], 'required'],
            [['alumnos_id', 'esta_en_tratamiento'], 'integer'],
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
            'esta_en_tratamiento' => 'Esta En Tratamiento',
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
     * Gets query for [[Tratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamientos::class, ['alum_tratamientos_id' => 'id']);
    }
}
