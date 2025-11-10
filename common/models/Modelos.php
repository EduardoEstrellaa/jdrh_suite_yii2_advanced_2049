<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "modelos".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $marcas_id
 *
 * @property Equipos[] $equipos
 * @property Marcas $marcas
 */
class Modelos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modelos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'marcas_id'], 'required'],
            [['marcas_id'], 'integer'],
            [['descripcion'], 'string', 'max' => 100],
            [['marcas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::class, 'targetAttribute' => ['marcas_id' => 'id']],
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
            'marcas_id' => 'Marcas ID',
        ];
    }

    /**
     * Gets query for [[Equipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::class, ['modelos_id' => 'id']);
    }

    /**
     * Gets query for [[Marcas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcas()
    {
        return $this->hasOne(Marcas::class, ['id' => 'marcas_id']);
    }
}
