<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_bienes_vivienda".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property ViviendaBienes[] $viviendaBienes
 */
class CatalogoBienesVivienda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_bienes_vivienda';
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
     * Gets query for [[ViviendaBienes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViviendaBienes()
    {
        return $this->hasMany(ViviendaBienes::class, ['catalogo_bienes_vivienda_id' => 'id']);
    }
}
