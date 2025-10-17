<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_servicios_vivienda".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property ViviendaServicios[] $viviendaServicios
 */
class CatalogoServiciosVivienda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_servicios_vivienda';
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
     * Gets query for [[ViviendaServicios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViviendaServicios()
    {
        return $this->hasMany(ViviendaServicios::class, ['catalogo_servicios_vivienda_id' => 'id']);
    }
}
