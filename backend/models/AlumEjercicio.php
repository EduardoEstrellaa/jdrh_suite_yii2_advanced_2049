<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_ejercicio".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $haces_ejercicio_fisico
 *
 * @property Alumnos $alumnos
 * @property EjercicioFisico[] $ejercicioFisicos
 */
class AlumEjercicio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_ejercicio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'haces_ejercicio_fisico'], 'required'],
            [['alumnos_id', 'haces_ejercicio_fisico'], 'integer'],
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
            'haces_ejercicio_fisico' => 'Haces Ejercicio Fisico',
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
     * Gets query for [[EjercicioFisicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEjercicioFisicos()
    {
        return $this->hasMany(EjercicioFisico::class, ['alum_ejercicio_id' => 'id']);
    }
}
