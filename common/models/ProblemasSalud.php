<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "problemas_salud".
 *
 * @property int $id
 * @property int $alum_estado_salud_id
 * @property int $catalogo_problemas_salud_id
 * @property string|null $otro_especificar
 * @property int $tipo_gravedad_id
 *
 * @property AlumEstadoSalud $alumEstadoSalud
 * @property CatalogoProblemasSalud $catalogoProblemasSalud
 * @property TipoGravedad $tipoGravedad
 */
class ProblemasSalud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'problemas_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alum_estado_salud_id', 'catalogo_problemas_salud_id', 'tipo_gravedad_id'], 'required'],
            [['alum_estado_salud_id', 'catalogo_problemas_salud_id', 'tipo_gravedad_id'], 'integer'],
            [['otro_especificar'], 'string', 'max' => 150],
            [['alum_estado_salud_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumEstadoSalud::class, 'targetAttribute' => ['alum_estado_salud_id' => 'id']],
            [['catalogo_problemas_salud_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoProblemasSalud::class, 'targetAttribute' => ['catalogo_problemas_salud_id' => 'id']],
            [['tipo_gravedad_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoGravedad::class, 'targetAttribute' => ['tipo_gravedad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_estado_salud_id' => 'Alum Estado Salud ID',
            'catalogo_problemas_salud_id' => 'Catalogo Problemas Salud ID',
            'otro_especificar' => 'Otro Especificar',
            'tipo_gravedad_id' => 'Tipo Gravedad ID',
        ];
    }

    /**
     * Gets query for [[AlumEstadoSalud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumEstadoSalud()
    {
        return $this->hasOne(AlumEstadoSalud::class, ['id' => 'alum_estado_salud_id']);
    }

    /**
     * Gets query for [[CatalogoProblemasSalud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoProblemasSalud()
    {
        return $this->hasOne(CatalogoProblemasSalud::class, ['id' => 'catalogo_problemas_salud_id']);
    }

    /**
     * Gets query for [[TipoGravedad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoGravedad()
    {
        return $this->hasOne(TipoGravedad::class, ['id' => 'tipo_gravedad_id']);
    }
}
