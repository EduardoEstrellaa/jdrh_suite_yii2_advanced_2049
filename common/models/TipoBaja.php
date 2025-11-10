<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_baja".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property BajaEquipo[] $bajaEquipos
 */
class TipoBaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_baja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 45],
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
     * Gets query for [[BajaEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBajaEquipos()
    {
        return $this->hasMany(BajaEquipo::class, ['tipo_baja_id' => 'id']);
    }
}
