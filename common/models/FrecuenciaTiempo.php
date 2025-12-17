<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "frecuencia_tiempo".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property AlumAsisteDentista[] $alumAsisteDentistas
 * @property AlumAsisteMedico[] $alumAsisteMedicos
 * @property Tratamientos[] $tratamientos
 */
class FrecuenciaTiempo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frecuencia_tiempo';
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
     * Opciones para dropdown (id => nombre).
     */
    public static function dropdownOptions(): array
    {
        $records = static::find()
            ->select(['id', 'nombre'])
            ->orderBy(['nombre' => SORT_ASC])
            ->asArray()
            ->all();

        return ArrayHelper::map($records, 'id', 'nombre');
    }

    /**
     * Gets query for [[AlumAsisteDentistas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumAsisteDentistas()
    {
        return $this->hasMany(AlumAsisteDentista::class, ['frecuencia_tiempo_id' => 'id']);
    }

    /**
     * Gets query for [[AlumAsisteMedicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumAsisteMedicos()
    {
        return $this->hasMany(AlumAsisteMedico::class, ['frecuencia_tiempo_id' => 'id']);
    }

    /**
     * Gets query for [[Tratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamientos::class, ['frecuencia_tiempo_id' => 'id']);
    }
}
