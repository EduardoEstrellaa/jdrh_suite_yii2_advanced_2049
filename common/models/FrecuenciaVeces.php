<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "frecuencia_veces".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property AlumConsumoAlimentos[] $alumConsumoAlimentos
 */
class FrecuenciaVeces extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frecuencia_veces';
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
     * Gets query for [[AlumConsumoAlimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumConsumoAlimentos()
    {
        return $this->hasMany(AlumConsumoAlimentos::class, ['frecuencia_veces_id' => 'id']);
    }
}
