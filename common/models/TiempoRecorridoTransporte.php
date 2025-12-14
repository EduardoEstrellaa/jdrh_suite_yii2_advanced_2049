<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tiempo_recorrido_transporte".
 *
 * @property int $id
 * @property string $rango_tiempo
 * @property string|null $descripcion
 *
 * @property AlumTransportes[] $alumTransportes
 */
class TiempoRecorridoTransporte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiempo_recorrido_transporte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rango_tiempo'], 'required'],
            [['rango_tiempo'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rango_tiempo' => 'Rango Tiempo',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Returns a map for dropdowns keyed by id.
     *
     * @return array
     */
    public static function dropdownOptions(): array
    {
        return static::find()
            ->select('rango_tiempo')
            ->indexBy('id')
            ->orderBy('rango_tiempo')
            ->column();
    }

    /**
     * Gets query for [[AlumTransportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumTransportes()
    {
        return $this->hasMany(AlumTransportes::class, ['tiempo_recorrido_transporte_id' => 'id']);
    }
}
