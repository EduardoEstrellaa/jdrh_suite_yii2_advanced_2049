<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_transportes".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $catalogo_transportes_id
 * @property int $tiempo_recorrido_transporte_id
 *
 * @property Alumnos $alumnos
 * @property CatalogoTransportes $catalogoTransportes
 * @property TiempoRecorridoTransporte $tiempoRecorridoTransporte
 */
class AlumTransportes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_transportes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'catalogo_transportes_id', 'tiempo_recorrido_transporte_id'], 'required'],
            [['alumnos_id', 'catalogo_transportes_id', 'tiempo_recorrido_transporte_id'], 'integer'],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['catalogo_transportes_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoTransportes::class, 'targetAttribute' => ['catalogo_transportes_id' => 'id']],
            [['tiempo_recorrido_transporte_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiempoRecorridoTransporte::class, 'targetAttribute' => ['tiempo_recorrido_transporte_id' => 'id']],
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
            'catalogo_transportes_id' => 'Catalogo Transportes ID',
            'tiempo_recorrido_transporte_id' => 'Tiempo Recorrido Transporte ID',
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
     * Gets query for [[CatalogoTransportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoTransportes()
    {
        return $this->hasOne(CatalogoTransportes::class, ['id' => 'catalogo_transportes_id']);
    }

    /**
     * Gets query for [[TiempoRecorridoTransporte]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiempoRecorridoTransporte()
    {
        return $this->hasOne(TiempoRecorridoTransporte::class, ['id' => 'tiempo_recorrido_transporte_id']);
    }
}
