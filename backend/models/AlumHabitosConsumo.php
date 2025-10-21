<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_habitos_consumo".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $fumas
 * @property int $catalogo_cigarros_dia_id
 * @property int $tomas_alcohol
 * @property int $frecuencia_veces_semana_id
 * @property int $tienes_adicciones
 * @property string|null $especificiar_adiccion
 *
 * @property Alumnos $alumnos
 * @property CatalogoCigarrosDia $catalogoCigarrosDia
 * @property FrecuenciaVecesSemana $frecuenciaVecesSemana
 */
class AlumHabitosConsumo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_habitos_consumo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['especificiar_adiccion'], 'default', 'value' => null],
            [['alumnos_id', 'fumas', 'catalogo_cigarros_dia_id', 'tomas_alcohol', 'frecuencia_veces_semana_id', 'tienes_adicciones'], 'required'],
            [['alumnos_id', 'fumas', 'catalogo_cigarros_dia_id', 'tomas_alcohol', 'frecuencia_veces_semana_id', 'tienes_adicciones'], 'integer'],
            [['especificiar_adiccion'], 'string', 'max' => 250],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['catalogo_cigarros_dia_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoCigarrosDia::class, 'targetAttribute' => ['catalogo_cigarros_dia_id' => 'id']],
            [['frecuencia_veces_semana_id'], 'exist', 'skipOnError' => true, 'targetClass' => FrecuenciaVecesSemana::class, 'targetAttribute' => ['frecuencia_veces_semana_id' => 'id']],
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
            'fumas' => 'Fumas',
            'catalogo_cigarros_dia_id' => 'Catalogo Cigarros Dia ID',
            'tomas_alcohol' => 'Tomas Alcohol',
            'frecuencia_veces_semana_id' => 'Frecuencia Veces Semana ID',
            'tienes_adicciones' => 'Tienes Adicciones',
            'especificiar_adiccion' => 'Especificiar Adiccion',
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
     * Gets query for [[CatalogoCigarrosDia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoCigarrosDia()
    {
        return $this->hasOne(CatalogoCigarrosDia::class, ['id' => 'catalogo_cigarros_dia_id']);
    }

    /**
     * Gets query for [[FrecuenciaVecesSemana]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrecuenciaVecesSemana()
    {
        return $this->hasOne(FrecuenciaVecesSemana::class, ['id' => 'frecuencia_veces_semana_id']);
    }

}
