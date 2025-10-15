<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lugares_nacimiento".
 *
 * @property int $id
 * @property int $perfil_id
 * @property int $entidades_federativas_id
 * @property int $municipios_id
 * @property int $localidades_id
 *
 * @property EntidadesFederativas $entidadesFederativas
 * @property Localidades $localidades
 * @property Municipios $municipios
 * @property Perfil $perfil
 */
class LugaresNacimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lugares_nacimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perfil_id', 'entidades_federativas_id', 'municipios_id', 'localidades_id'], 'required'],
            [['id', 'perfil_id', 'entidades_federativas_id', 'municipios_id', 'localidades_id'], 'integer'],
            [['id'], 'unique'],
            [['entidades_federativas_id'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadesFederativas::class, 'targetAttribute' => ['entidades_federativas_id' => 'id']],
            [['localidades_id'], 'exist', 'skipOnError' => true, 'targetClass' => Localidades::class, 'targetAttribute' => ['localidades_id' => 'id']],
            [['municipios_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipios::class, 'targetAttribute' => ['municipios_id' => 'id']],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::class, 'targetAttribute' => ['perfil_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perfil_id' => 'Perfil ID',
            'entidades_federativas_id' => 'Entidades Federativas ID',
            'municipios_id' => 'Municipios ID',
            'localidades_id' => 'Localidades ID',
        ];
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
     * Gets query for [[Localidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidades()
    {
        return $this->hasOne(Localidades::class, ['id' => 'localidades_id']);
    }

    /**
     * Gets query for [[Municipios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasOne(Municipios::class, ['id' => 'municipios_id']);
    }

    /**
     * Gets query for [[Perfil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfil::class, ['id' => 'perfil_id']);
    }
}
