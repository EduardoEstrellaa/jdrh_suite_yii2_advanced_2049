<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipo_alergias".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property CatalogoAlergias[] $catalogoAlergias
 */
class TipoAlergias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_alergias';
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
     * Gets query for [[CatalogoAlergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoAlergias()
    {
        return $this->hasMany(CatalogoAlergias::class, ['tipo_alergias_id' => 'id']);
    }
}
