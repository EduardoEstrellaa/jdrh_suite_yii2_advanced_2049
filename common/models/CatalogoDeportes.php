<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalogo_deportes".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Deportes[] $deportes
 */
class CatalogoDeportes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_deportes';
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
     * Gets query for [[Deportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeportes()
    {
        return $this->hasMany(Deportes::class, ['catalogo_deportes_id' => 'id']);
    }
}
