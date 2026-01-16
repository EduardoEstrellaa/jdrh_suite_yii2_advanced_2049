<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalogo_actividad_ejercicio".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property EjercicioFisico[] $ejercicioFisicos
 */
class CatalogoActividadEjercicio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_actividad_ejercicio';
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
     * Gets query for [[EjercicioFisicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEjercicioFisicos()
    {
        return $this->hasMany(EjercicioFisico::class, ['catalogo_actividad_ejercicio_id' => 'id']);
    }
}
