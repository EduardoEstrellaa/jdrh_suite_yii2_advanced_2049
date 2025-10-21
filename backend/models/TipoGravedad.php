<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipo_gravedad".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property Alergias[] $alergias
 * @property ProblemasSalud[] $problemasSaluds
 */
class TipoGravedad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_gravedad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 150],
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
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Alergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlergias()
    {
        return $this->hasMany(Alergias::class, ['tipo_gravedad_id' => 'id']);
    }

    /**
     * Gets query for [[ProblemasSaluds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProblemasSaluds()
    {
        return $this->hasMany(ProblemasSalud::class, ['tipo_gravedad_id' => 'id']);
    }
}
