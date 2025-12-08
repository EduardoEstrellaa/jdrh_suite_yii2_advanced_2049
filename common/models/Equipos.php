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
 * @property int $tipo_alta_id
 * @property int $estado_equipo_id
 */
class Equipos extends \yii\db\ActiveRecord
{
    public $file_foto_equipo;
    public $file_foto_numero_inventario;
    public $file_foto_numero_serie;

    public static function tableName()
    {
        return 'equipos';
    }

    public function rules()
    {
        return [
            [['marca_id', 'modelos_id', 'estado_equipo_id', 'tipo_equipo_id', 'tipo_alta_id', 'numero_inventario'], 'required'],
            [['marca_id', 'modelos_id', 'estado_equipo_id', 'tipo_equipo_id', 'tipo_alta_id'], 'integer'],
            [['fecha_alta'], 'safe'],
            [['foto_equipo', 'foto_numero_inventario', 'foto_numero_serie', 'observaciones', 'especificaciones'], 'string'],
            [['numero_inventario'], 'string', 'max' => 50],
            [['numero_serie'], 'string', 'max' => 100],
            [['estado_equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoEquipo::class, 'targetAttribute' => ['estado_equipo_id' => 'id']],
            [['modelos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modelos::class, 'targetAttribute' => ['modelos_id' => 'id']],
            [['tipo_alta_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAlta::class, 'targetAttribute' => ['tipo_alta_id' => 'id']],
            [['tipo_equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEquipo::class, 'targetAttribute' => ['tipo_equipo_id' => 'id']],
            [['marca_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::class, 'targetAttribute' => ['marca_id' => 'id']],

            [['file_foto_equipo', 'file_foto_numero_inventario', 'file_foto_numero_serie'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 5 * 1024 * 1024,
            ],
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
            'tipo_alta_id' => 'Tipo de Alta',
            'estado_equipo_id' => 'Estado del Equipo',
        ];
    }

    /** RELACIONES CORRECTAS */
    public function getMarca()
    {
        return $this->hasOne(Marcas::class, ['id' => 'marca_id']);
    }

    public function getModelo()
    {
        return $this->hasOne(Modelos::class, ['id' => 'modelos_id']);
    }

    public function getTipoEquipo()
    {
        return $this->hasOne(TipoEquipo::class, ['id' => 'tipo_equipo_id']);
    }

    public function getTipoAlta()
    {
        return $this->hasOne(TipoAlta::class, ['id' => 'tipo_alta_id']);
    }

    public function getEstadoEquipo()
    {
        return $this->hasOne(EstadoEquipo::class, ['id' => 'estado_equipo_id']);
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if (empty($this->fecha_alta)) {
                $this->fecha_alta = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

    public function getImageUrl($attribute)
    {
        if (!$this->$attribute) {
            return null;
        }

        return Yii::getAlias('@frontendUrl') . "/uploads/equipos/" . $this->$attribute;
    }
}
