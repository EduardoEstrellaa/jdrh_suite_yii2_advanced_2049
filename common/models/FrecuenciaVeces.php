<?php

namespace common\models;

use Yii;

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
     * Gets query for [[AlumConsumoAlimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumConsumoAlimentos()
    {
        return $this->hasMany(AlumConsumoAlimentos::class, ['frecuencia_veces_id' => 'id']);
    }
}
