<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $edificios_id
 *
 * @property Asignacion[] $asignacions
 * @property Edificios $edificios
 * @property HistorialTraslado[] $historialTraslados
 * @property HistorialTraslado[] $historialTraslados0
 */
class Departamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'edificios_id'], 'required'],
            [['edificios_id'], 'integer'],
            [['descripcion'], 'string', 'max' => 100],
            [['edificios_id'], 'exist', 'skipOnError' => true, 'targetClass' => Edificios::class, 'targetAttribute' => ['edificios_id' => 'id']],
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
            'edificios_id' => 'Edificios ID',
        ];
    }

    /**
     * Gets query for [[Asignacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::class, ['departamentos_id' => 'id']);
    }

    /**
     * Gets query for [[Edificios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEdificios()
    {
        return $this->hasOne(Edificios::class, ['id' => 'edificios_id']);
    }

    /**
     * Gets query for [[HistorialTraslados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialTraslados()
    {
        return $this->hasMany(HistorialTraslado::class, ['departamento_origen_id' => 'id']);
    }

    /**
     * Gets query for [[HistorialTraslados0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialTraslados0()
    {
        return $this->hasMany(HistorialTraslado::class, ['departamento_destino_id' => 'id']);
    }
}
