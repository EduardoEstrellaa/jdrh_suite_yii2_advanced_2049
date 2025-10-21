<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tratamientos".
 *
 * @property int $id
 * @property int $alum_tratamientos_id
 * @property int $catalogo_tratamientos_id
 * @property int $frecuencia_tiempo_id
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 *
 * @property AlumTratamientos $alumTratamientos
 * @property CatalogoTratamientos $catalogoTratamientos
 * @property FrecuenciaTiempo $frecuenciaTiempo
 */
class Tratamientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tratamientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_tratamientos_id', 'catalogo_tratamientos_id', 'frecuencia_tiempo_id'], 'required'],
            [['id', 'alum_tratamientos_id', 'catalogo_tratamientos_id', 'frecuencia_tiempo_id'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['id'], 'unique'],
            [['alum_tratamientos_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumTratamientos::class, 'targetAttribute' => ['alum_tratamientos_id' => 'id']],
            [['catalogo_tratamientos_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoTratamientos::class, 'targetAttribute' => ['catalogo_tratamientos_id' => 'id']],
            [['frecuencia_tiempo_id'], 'exist', 'skipOnError' => true, 'targetClass' => FrecuenciaTiempo::class, 'targetAttribute' => ['frecuencia_tiempo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_tratamientos_id' => 'Alum Tratamientos ID',
            'catalogo_tratamientos_id' => 'Catalogo Tratamientos ID',
            'frecuencia_tiempo_id' => 'Frecuencia Tiempo ID',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
        ];
    }

    /**
     * Gets query for [[AlumTratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumTratamientos()
    {
        return $this->hasOne(AlumTratamientos::class, ['id' => 'alum_tratamientos_id']);
    }

    /**
     * Gets query for [[CatalogoTratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoTratamientos()
    {
        return $this->hasOne(CatalogoTratamientos::class, ['id' => 'catalogo_tratamientos_id']);
    }

    /**
     * Gets query for [[FrecuenciaTiempo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrecuenciaTiempo()
    {
        return $this->hasOne(FrecuenciaTiempo::class, ['id' => 'frecuencia_tiempo_id']);
    }
}
