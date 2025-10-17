<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_vivienda".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $vives_casa_padres
 * @property string|null $otro_especificar
 * @property int $tipos_viviendas_id
 * @property string|null $otro_tipo_especificar
 *
 * @property Alumnos $alumnos
 * @property TiposViviendas $tiposViviendas
 * @property ViviendaBienes[] $viviendaBienes
 * @property ViviendaServicios[] $viviendaServicios
 */
class AlumVivienda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_vivienda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'vives_casa_padres', 'tipos_viviendas_id'], 'required'],
            [['alumnos_id', 'vives_casa_padres', 'tipos_viviendas_id'], 'integer'],
            [['otro_especificar', 'otro_tipo_especificar'], 'string', 'max' => 250],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['tipos_viviendas_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposViviendas::class, 'targetAttribute' => ['tipos_viviendas_id' => 'id']],
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
            'vives_casa_padres' => 'Vives Casa Padres',
            'otro_especificar' => 'Otro Especificar',
            'tipos_viviendas_id' => 'Tipos Viviendas ID',
            'otro_tipo_especificar' => 'Otro Tipo Especificar',
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
     * Gets query for [[TiposViviendas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiposViviendas()
    {
        return $this->hasOne(TiposViviendas::class, ['id' => 'tipos_viviendas_id']);
    }

    /**
     * Gets query for [[ViviendaBienes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViviendaBienes()
    {
        return $this->hasMany(ViviendaBienes::class, ['alum_vivienda_id' => 'id']);
    }

    /**
     * Gets query for [[ViviendaServicios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViviendaServicios()
    {
        return $this->hasMany(ViviendaServicios::class, ['alum_vivienda_id' => 'id']);
    }
}
