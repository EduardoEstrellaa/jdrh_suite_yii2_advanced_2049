<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "entidades_federativas".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property DomiciliosActuales[] $domiciliosActuales
 * @property LugaresNacimiento[] $lugaresNacimientos
 * @property Municipios[] $municipios
 */
class EntidadesFederativas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entidades_federativas';
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
        return $this->hasMany(DomiciliosActuales::class, ['entidades_federativas_id' => 'id']);
    }

    /**
     * Gets query for [[LugaresNacimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLugaresNacimientos()
    {
        return $this->hasMany(LugaresNacimiento::class, ['entidades_federativas_id' => 'id']);
    }

    /**
     * Gets query for [[Municipios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipios::class, ['entidades_federativas_id' => 'id']);
    }

    /**
     * Devuelve un arreglo [id => nombre] de todos los estados
     *
     * @return array<int, string>
     */
    public static function getEntidadesFederativasMap(): array
    {
        $estados = self::find()
            ->select(['id', 'nombre'])
            ->orderBy(['nombre' => SORT_ASC])
            ->asArray()
            ->all();

        return ArrayHelper::map($estados, 'id', 'nombre');
    }
}
