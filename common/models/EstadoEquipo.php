<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estado_equipo".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Equipos[] $equipos
 */
class EstadoEquipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
{
    return [
        [['descripcion'], 'required'],
        [['descripcion'], 'string', 'max' => 100],
    ];
}


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Equipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::class, ['estado_equipo_id' => 'id']);
    }
}
