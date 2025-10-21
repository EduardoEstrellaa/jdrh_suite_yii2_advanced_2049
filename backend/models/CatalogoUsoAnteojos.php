<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_uso_anteojos".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property UsoAnteojos[] $usoAnteojos
 */
class CatalogoUsoAnteojos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_uso_anteojos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre'], 'required'],
            [['id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
            [['id'], 'unique'],
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
     * Gets query for [[UsoAnteojos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsoAnteojos()
    {
        return $this->hasMany(UsoAnteojos::class, ['catalogo_uso_anteojos_id' => 'id']);
    }
}
