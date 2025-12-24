<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alum_consumo_alimentos".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $catalogo_alimentos_id
 * @property int $frecuencia_veces_id
 *
 * @property Alumnos $alumnos
 * @property CatalogoAlimentos $catalogoAlimentos
 * @property FrecuenciaVeces $frecuenciaVeces
 */
class AlumConsumoAlimentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_consumo_alimentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'catalogo_alimentos_id', 'frecuencia_veces_id'], 'required'],
            [['alumnos_id', 'catalogo_alimentos_id', 'frecuencia_veces_id'], 'integer'],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['catalogo_alimentos_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoAlimentos::class, 'targetAttribute' => ['catalogo_alimentos_id' => 'id']],
            [['frecuencia_veces_id'], 'exist', 'skipOnError' => true, 'targetClass' => FrecuenciaVeces::class, 'targetAttribute' => ['frecuencia_veces_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alumnos_id' => 'Alumnos ID',
            'catalogo_alimentos_id' => 'Catalogo Alimentos ID',
            'frecuencia_veces_id' => 'Frecuencia Veces ID',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasOne(Alumnos::class, ['id' => 'alumnos_id']);
    }

    /**
     * Gets query for [[CatalogoAlimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoAlimentos()
    {
        return $this->hasOne(CatalogoAlimentos::class, ['id' => 'catalogo_alimentos_id']);
    }

    /**
     * Gets query for [[FrecuenciaVeces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrecuenciaVeces()
    {
        return $this->hasOne(FrecuenciaVeces::class, ['id' => 'frecuencia_veces_id']);
    }
}
