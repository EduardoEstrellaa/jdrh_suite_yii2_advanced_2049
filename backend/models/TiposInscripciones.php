<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipos_inscripciones".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property AlumInscripciones[] $alumInscripciones
 */
class TiposInscripciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_inscripciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
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
     * Gets query for [[AlumInscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInscripciones()
    {
        return $this->hasMany(AlumInscripciones::class, ['tipos_inscripciones_id' => 'id']);
    }
}
