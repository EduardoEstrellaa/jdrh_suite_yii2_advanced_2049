<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "historial_traslado".
 *
 * @property int $id
 * @property int $equipos_id
 * @property string|null $motivo_traslado
 * @property int|null $departamento_origen_id
 * @property int $departamento_destino_id
 * @property int|null $usuario_responsable
 * @property string|null $fecha_traslado
 *
 * @property Departamentos $departamentoDestino
 * @property Departamentos $departamentoOrigen
 * @property Equipos $equipos
 */
class HistorialTraslado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historial_traslado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipos_id', 'departamento_destino_id'], 'required'],
            [['equipos_id', 'departamento_origen_id', 'departamento_destino_id', 'usuario_responsable'], 'integer'],
            [['fecha_traslado'], 'safe'],
            [['motivo_traslado'], 'string', 'max' => 250],
            [['departamento_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::class, 'targetAttribute' => ['departamento_origen_id' => 'id']],
            [['departamento_destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::class, 'targetAttribute' => ['departamento_destino_id' => 'id']],
            [['equipos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::class, 'targetAttribute' => ['equipos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipos_id' => 'Equipos ID',
            'motivo_traslado' => 'Motivo Traslado',
            'departamento_origen_id' => 'Departamento Origen ID',
            'departamento_destino_id' => 'Departamento Destino ID',
            'usuario_responsable' => 'Usuario Responsable',
            'fecha_traslado' => 'Fecha Traslado',
        ];
    }

    /**
     * Gets query for [[DepartamentoDestino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentoDestino()
    {
        return $this->hasOne(Departamentos::class, ['id' => 'departamento_destino_id']);
    }

    /**
     * Gets query for [[DepartamentoOrigen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentoOrigen()
    {
        return $this->hasOne(Departamentos::class, ['id' => 'departamento_origen_id']);
    }

    /**
     * Gets query for [[Equipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasOne(Equipos::class, ['id' => 'equipos_id']);
    }
}
