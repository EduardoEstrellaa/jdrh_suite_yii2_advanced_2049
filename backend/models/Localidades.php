<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "localidades".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property DomiciliosActuales[] $domiciliosActuales
 * @property LugaresNacimiento[] $lugaresNacimientos
 */
class Localidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localidades';
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
     * Gets query for [[DomiciliosActuales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomiciliosActuales()
    {
        return $this->hasMany(DomiciliosActuales::class, ['localidades_id' => 'id']);
    }

    /**
     * Gets query for [[LugaresNacimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLugaresNacimientos()
    {
        return $this->hasMany(LugaresNacimiento::class, ['localidades_id' => 'id']);
    }
}
