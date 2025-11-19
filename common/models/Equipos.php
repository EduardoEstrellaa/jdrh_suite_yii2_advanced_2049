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
 * @property int $modelos_id
 * @property int $tipo_equipo_id
 * @property int $tipo_alta_id
 * @property int $estado_equipo_id
 *
 * @property Asignacion[] $asignacions
 * @property BajaEquipo[] $bajaEquipos
 * @property EstadoEquipo $estadoEquipo
 * @property HistorialTraslado[] $historialTraslados
 * @property Modelos $modelos
 * @property TipoAlta $tipoAlta
 * @property TipoEquipo $tipoEquipo
 */
class Equipos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marca_id', 'modelos_id', 'estado_equipo_id'], 'required'],
            [['marca_id', 'modelos_id', 'estado_equipo_id'], 'integer'],
            [['fecha_alta', 'numero_inventario', 'modelos_id', 'tipo_equipo_id', 'tipo_alta_id', 'estado_equipo_id'], 'required'],
            [['fecha_alta'], 'safe'],
            [['foto_equipo', 'foto_numero_inventario', 'foto_numero_serie', 'observaciones', 'especificaciones'], 'string'],
            [['modelos_id', 'tipo_equipo_id', 'tipo_alta_id', 'estado_equipo_id'], 'integer'],
            [['numero_inventario'], 'string', 'max' => 50],
            [['numero_serie'], 'string', 'max' => 100],
            [['estado_equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoEquipo::class, 'targetAttribute' => ['estado_equipo_id' => 'id']],
            [['modelos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modelos::class, 'targetAttribute' => ['modelos_id' => 'id']],
            [['tipo_alta_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAlta::class, 'targetAttribute' => ['tipo_alta_id' => 'id']],
            [['tipo_equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEquipo::class, 'targetAttribute' => ['tipo_equipo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_alta' => 'Fecha Alta',
            'numero_inventario' => 'Numero Inventario',
            'numero_serie' => 'Numero Serie',
            'foto_equipo' => 'Foto Equipo',
            'foto_numero_inventario' => 'Foto Numero Inventario',
            'foto_numero_serie' => 'Foto Numero Serie',
            'observaciones' => 'Observaciones',
            'especificaciones' => 'Especificaciones',
            'modelos_id' => 'Modelos ID',
            'tipo_equipo_id' => 'Tipo Equipo ID',
            'tipo_alta_id' => 'Tipo Alta ID',
            'estado_equipo_id' => 'Estado Equipo ID',
        ];
    }

    /**
     * Gets query for [[Asignacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::class, ['equipos_id' => 'id']);
    }

    /**
     * Gets query for [[BajaEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBajaEquipos()
    {
        return $this->hasMany(BajaEquipo::class, ['equipos_id' => 'id']);
    }

    /**
     * Gets query for [[EstadoEquipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoEquipo()
    {
        return $this->hasOne(EstadoEquipo::class, ['id' => 'estado_equipo_id']);
    }

    /**
     * Gets query for [[HistorialTraslados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialTraslados()
    {
        return $this->hasMany(HistorialTraslado::class, ['equipos_id' => 'id']);
    }

    /**
     * Gets query for [[Modelos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModelos()
    {
        return $this->hasOne(Modelos::class, ['id' => 'modelos_id']);
    }

    /**
     * Gets query for [[TipoAlta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAlta()
    {
        return $this->hasOne(TipoAlta::class, ['id' => 'tipo_alta_id']);
    }

    /**
     * Gets query for [[TipoEquipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEquipo()
    {
        return $this->hasOne(TipoEquipo::class, ['id' => 'tipo_equipo_id']);
    }


    public function getMarca()
{
    return $this->hasOne(Marcas::class, ['id' => 'marca_id']);
}


}
