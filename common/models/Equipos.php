<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipos".
 *
 * @property int $id
 * @property string $fecha_alta
 * @property string $numero_inventario
 * @property string|null $numero_serie
 * @property string|null $foto_equipo
 * @property string|null $foto_numero_inventario
 * @property string|null $foto_numero_serie
 * @property string|null $observaciones
 * @property string|null $especificaciones
 * @property int $marca_id
 * @property int $modelos_id
 * @property int $tipo_equipo_id
 * @property int $id_alta
 * @property int $estado_equipo_id
 */
class Equipos extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'equipos';
    }

    public function rules()
    {
        return [
            // ✔ Tus reglas personalizadas (HEAD)
            [['marca_id', 'modelos_id', 'estado_equipo_id', 'tipo_equipo_id', 'id_alta', 'numero_inventario'], 'required'],
            [['marca_id', 'modelos_id', 'estado_equipo_id', 'tipo_equipo_id', 'id_alta'], 'integer'],

            // Fecha de alta
            [['fecha_alta'], 'safe'],

            // Textos largos
            [['foto_equipo', 'foto_numero_inventario', 'foto_numero_serie', 'observaciones', 'especificaciones'], 'string'],

            // Campos simples
            [['numero_inventario'], 'string', 'max' => 50],
            [['numero_serie'], 'string', 'max' => 100],

            // Relaciones
            [['estado_equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoEquipo::class, 'targetAttribute' => ['estado_equipo_id' => 'id']],
            [['modelos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modelos::class, 'targetAttribute' => ['modelos_id' => 'id']],
            [['id_alta'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAlta::class, 'targetAttribute' => ['id_alta' => 'id']],
            [['tipo_equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEquipo::class, 'targetAttribute' => ['tipo_equipo_id' => 'id']],
            [['marca_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::class, 'targetAttribute' => ['marca_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_alta' => 'Fecha de Alta',
            'numero_inventario' => 'Número de Inventario',
            'numero_serie' => 'Número de Serie',
            'foto_equipo' => 'Foto del Equipo',
            'foto_numero_inventario' => 'Foto Número Inventario',
            'foto_numero_serie' => 'Foto Número Serie',
            'observaciones' => 'Observaciones',
            'especificaciones' => 'Especificaciones',
            'marca_id' => 'Marca',
            'modelos_id' => 'Modelo',
            'tipo_equipo_id' => 'Tipo de Equipo',
            'id_alta' => 'Tipo de Alta',
            'estado_equipo_id' => 'Estado del Equipo',
        ];
    }

    public function getEstadoEquipo()
    {
        return $this->hasOne(EstadoEquipo::class, ['id' => 'estado_equipo_id']);
    }

    public function getModelos()
    {
        return $this->hasOne(Modelos::class, ['id' => 'modelos_id']);
    }

    public function getTipoAlta()
    {
        return $this->hasOne(TipoAlta::class, ['id' => 'id_alta']);
    }

    public function getTipoEquipo()
    {
        return $this->hasOne(TipoEquipo::class, ['id' => 'tipo_equipo_id']);
    }

    // ✔ Campo agregado por ti (HEAD)
    public function getMarca()
    {
        return $this->hasOne(Marcas::class, ['id' => 'marca_id']);
    }
}
