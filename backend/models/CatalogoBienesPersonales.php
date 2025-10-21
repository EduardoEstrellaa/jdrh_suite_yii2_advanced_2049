<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_bienes_personales".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property AlumBienesPersonales[] $alumBienesPersonales
 */
class CatalogoBienesPersonales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_bienes_personales';
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
     * Gets query for [[AlumBienesPersonales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumBienesPersonales()
    {
        return $this->hasMany(AlumBienesPersonales::class, ['catalogo_bienes_personales_id' => 'id']);
    }
}
