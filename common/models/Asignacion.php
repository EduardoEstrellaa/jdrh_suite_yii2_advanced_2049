<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asignacion".
 *
 * @property int $id
 * @property int $equipos_id
 * @property string|null $observaciones
 * @property string $fecha_asignacion
 * @property int $departamentos_id
 *
 * @property Departamentos $departamentos
 * @property Equipos $equipos
 */
class Asignacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipos_id', 'fecha_asignacion', 'departamentos_id'], 'required'],
            [['equipos_id', 'departamentos_id'], 'integer'],
            [['observaciones'], 'string'],
            [['fecha_asignacion'], 'safe'],
            [['departamentos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::class, 'targetAttribute' => ['departamentos_id' => 'id']],
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
            'observaciones' => 'Observaciones',
            'fecha_asignacion' => 'Fecha Asignacion',
            'departamentos_id' => 'Departamentos ID',
        ];
    }


    public function getDepartamentos()
    {
        return $this->hasOne(Departamentos::class, ['id' => 'departamentos_id']);
    }

    public function getEquipos()
    {
        return $this->hasOne(Equipos::class, ['id' => 'equipos_id']);
    }


    public function getEquipo()
    {
        return $this->hasOne(Equipos::class, ['id' => 'equipos_id']);
    }

    public function getDepartamento()
    {
        return $this->hasOne(Departamentos::class, ['id' => 'departamentos_id']);
    }
}