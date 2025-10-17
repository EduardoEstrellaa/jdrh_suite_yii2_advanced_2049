<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_transportes".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property AlumTransportes[] $alumTransportes
 */
class CatalogoTransportes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_transportes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 150],
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
        ];
    }

    /**
     * Gets query for [[AlumTransportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumTransportes()
    {
        return $this->hasMany(AlumTransportes::class, ['catalogo_transportes_id' => 'id']);
    }
}
