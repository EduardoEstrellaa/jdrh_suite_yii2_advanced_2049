<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categorias_dependencias".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property CatalogoDependenciasEconomicas[] $catalogoDependenciasEconomicas
 */
class CategoriasDependencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias_dependencias';
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
     * Gets query for [[CatalogoDependenciasEconomicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoDependenciasEconomicas()
    {
        return $this->hasMany(CatalogoDependenciasEconomicas::class, ['categorias_dependencias_id' => 'id']);
    }
}
