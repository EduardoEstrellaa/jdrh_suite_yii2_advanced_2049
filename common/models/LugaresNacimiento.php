<?php

namespace common\models;

use Yii;
use common\models\Perfil;


/**
 * This is the model class for table "lugares_nacimiento".
 *
 * @property int $id
 * @property int $perfil_id
 * @property int $entidades_federativas_id
 * @property int $municipios_id
 * @property string|null $localidad
 *
 * @property EntidadesFederativas $entidadesFederativas
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
            [['perfil_id', 'entidades_federativas_id', 'municipios_id'], 'required'],
            [['perfil_id', 'entidades_federativas_id', 'municipios_id'], 'integer'],
            [['localidad'], 'string', 'max' => 100],
            [['entidades_federativas_id'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadesFederativas::class, 'targetAttribute' => ['entidades_federativas_id' => 'id']],
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
            'localidad' => 'Localidad',
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
