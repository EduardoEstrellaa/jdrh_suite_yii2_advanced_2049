<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipos_viviendas".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property AlumVivienda[] $alumViviendas
 */
class TiposViviendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_viviendas';
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
     * Gets query for [[AlumViviendas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumViviendas()
    {
        return $this->hasMany(AlumVivienda::class, ['tipos_viviendas_id' => 'id']);
    }
}
