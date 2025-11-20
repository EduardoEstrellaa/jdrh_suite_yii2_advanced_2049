<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "baja_equipo".
 *
 * @property int $id
 * @property int $equipos_id
 * @property string $observaciones
 * @property int $tipo_baja_id
 * @property string $fecha_baja
 *
 * @property Equipos $equipos
 * @property TipoBaja $tipoBaja
 */
class BajaEquipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'baja_equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipos_id', 'observaciones', 'tipo_baja_id', 'fecha_baja'], 'required'],
            [['equipos_id', 'tipo_baja_id'], 'integer'],
            [['observaciones'], 'string'],
            [['fecha_baja'], 'safe'],
            [['equipos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['equipos_id' => 'id']],
            [['tipo_baja_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoBaja::class, 'targetAttribute' => ['tipo_baja_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipos_id' => 'Equipos ID',
            'observaciones' => 'Observaciones',
            'tipo_baja_id' => 'Tipo Baja ID',
            'fecha_baja' => 'Fecha Baja',
        ];
    }

    /**
     * Gets query for [[Equipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasOne(Equipos::class, ['id' => 'equipos_id']);
    }

    /**
     * Gets query for [[TipoBaja]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoBaja()
    {
        return $this->hasOne(TipoBaja::class, ['id' => 'tipo_baja_id']);
    }
}
