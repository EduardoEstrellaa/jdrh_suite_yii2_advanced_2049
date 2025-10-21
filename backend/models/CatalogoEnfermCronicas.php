<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_enferm_cronicas".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property EnfermedadesCronicas[] $enfermedadesCronicas
 */
class CatalogoEnfermCronicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_enferm_cronicas';
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
     * Gets query for [[EnfermedadesCronicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadesCronicas()
    {
        return $this->hasMany(EnfermedadesCronicas::class, ['catalogo_enferm_cronicas_id' => 'id']);
    }
}
