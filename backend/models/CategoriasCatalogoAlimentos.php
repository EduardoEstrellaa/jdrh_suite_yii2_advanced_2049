<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categorias_catalogo_alimentos".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property CatalogoAlimentos[] $catalogoAlimentos
 */
class CategoriasCatalogoAlimentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias_catalogo_alimentos';
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
     * Gets query for [[CatalogoAlimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoAlimentos()
    {
        return $this->hasMany(CatalogoAlimentos::class, ['categorias_catalogo_alimentos_id' => 'id']);
    }
}
