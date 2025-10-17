<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipos_becas".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property AlumBecas[] $alumBecas
 */
class TiposBecas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_becas';
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
     * Gets query for [[AlumBecas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumBecas()
    {
        return $this->hasMany(AlumBecas::class, ['tipos_becas_id' => 'id']);
    }
}
