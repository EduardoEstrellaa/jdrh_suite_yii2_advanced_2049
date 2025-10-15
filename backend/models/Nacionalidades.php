<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nacionalidades".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property DatosGenerales[] $datosGenerales
 */
class Nacionalidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nacionalidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre'], 'required'],
            [['id'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
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
     * Gets query for [[DatosGenerales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatosGenerales()
    {
        return $this->hasMany(DatosGenerales::class, ['nacionalidades_id' => 'id']);
    }
}
