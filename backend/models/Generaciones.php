<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "generaciones".
 *
 * @property int $id
 * @property string $nombre
 * @property string $anio_inicio
 * @property string $anio_fin
 * @property string $descripcion
 *
 * @property Alumnos[] $alumnos
 */
class Generaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'generaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'anio_inicio', 'anio_fin', 'descripcion'], 'required'],
            [['anio_inicio', 'anio_fin'], 'safe'],
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
            'anio_inicio' => 'Anio Inicio',
            'anio_fin' => 'Anio Fin',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::class, ['generaciones_id' => 'id']);
    }
}
