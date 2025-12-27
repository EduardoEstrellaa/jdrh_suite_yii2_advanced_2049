<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "frecuencia_veces_semana".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property AlumHabitosConsumo[] $alumHabitosConsumos
 * @property EjercicioFisico[] $ejercicioFisicos
 */
class FrecuenciaVecesSemana extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frecuencia_veces_semana';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[AlumHabitosConsumos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumHabitosConsumos()
    {
        return $this->hasMany(AlumHabitosConsumo::class, ['frecuencia_veces_semana_id' => 'id']);
    }

    /**
     * Gets query for [[EjercicioFisicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEjercicioFisicos()
    {
        return $this->hasMany(EjercicioFisico::class, ['frecuencia_veces_semana_id' => 'id']);
    }
}
