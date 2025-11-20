<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "municipios".
 *
 * @property int $id
 * @property string $nombre
 * @property int $entidades_federativas_id
 *
 * @property DomiciliosActuales[] $domiciliosActuales
 * @property EntidadesFederativas $entidadesFederativas
 * @property LugaresNacimiento[] $lugaresNacimientos
 */
class Municipios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'entidades_federativas_id'], 'required'],
            [['entidades_federativas_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['entidades_federativas_id'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadesFederativas::class, 'targetAttribute' => ['entidades_federativas_id' => 'id']],
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
            'entidades_federativas_id' => 'Entidades Federativas ID',
        ];
    }

    /**
     * Gets query for [[DomiciliosActuales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDomiciliosActuales()
    {
        return $this->hasMany(DomiciliosActuales::class, ['municipios_id' => 'id']);
    }

    /**
     * Gets query for [[EntidadesFederativas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadesFederativas()
    {
        return $this->hasOne(EntidadesFederativas::class, ['id' => 'entidades_federativas_id']);
    }

    /**
     * Gets query for [[LugaresNacimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLugaresNacimientos()
    {
        return $this->hasMany(LugaresNacimiento::class, ['municipios_id' => 'id']);
    }
}
