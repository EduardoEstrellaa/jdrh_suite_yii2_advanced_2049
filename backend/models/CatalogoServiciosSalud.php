<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_servicios_salud".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property ServiciosSalud[] $serviciosSaluds
 */
class CatalogoServiciosSalud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_servicios_salud';
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
     * Gets query for [[ServiciosSaluds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiciosSaluds()
    {
        return $this->hasMany(ServiciosSalud::class, ['catalogo_servicios_salud_id' => 'id']);
    }
}
