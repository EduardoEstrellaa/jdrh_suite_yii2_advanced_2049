<?php

namespace backend\models;

use Yii;

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
     * Gets query for [[AlumHabitosConsumos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumHabitosConsumos()
    {
        return $this->hasMany(AlumHabitosConsumo::class, ['catalogo_cigarros_dia_id' => 'id']);
    }

}
