<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_organizacion".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property CatalogoOrganizaciones[] $catalogoOrganizaciones
 */
class TipoOrganizacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_organizacion';
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
     * Gets query for [[CatalogoOrganizaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoOrganizaciones()
    {
        return $this->hasMany(CatalogoOrganizaciones::class, ['tipo_organizacion_id' => 'id']);
    }
}
