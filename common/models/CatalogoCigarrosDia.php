<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalogo_cigarros_dia".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property AlumHabitosConsumo[] $alumHabitosConsumos
 */
class CatalogoCigarrosDia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_cigarros_dia';
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
     * Gets query for [[AlumHabitosConsumos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumHabitosConsumos()
    {
        return $this->hasMany(AlumHabitosConsumo::class, ['catalogo_cigarros_dia_id' => 'id']);
    }
}
