<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "semestres".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $tipo_semestres_id
 *
 * @property CiclosSemestres[] $ciclosSemestres
 * @property PlanSemestres[] $planSemestres
 * @property TipoSemestres $tipoSemestres
 * @property UnidadesEstudio[] $unidadesEstudios
 */
class Semestres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semestres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'tipo_semestres_id'], 'required'],
            [['tipo_semestres_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
            [['tipo_semestres_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoSemestres::class, 'targetAttribute' => ['tipo_semestres_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'tipo_semestres_id' => 'Tipo Semestres ID',
        ];
    }

    /**
     * Gets query for [[CiclosSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosSemestres()
    {
        return $this->hasMany(CiclosSemestres::class, ['semestres_id' => 'id']);
    }

    /**
     * Gets query for [[PlanSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanSemestres()
    {
        return $this->hasMany(PlanSemestres::class, ['semestres_id' => 'id']);
    }

    /**
     * Gets query for [[TipoSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoSemestres()
    {
        return $this->hasOne(TipoSemestres::class, ['id' => 'tipo_semestres_id']);
    }

    /**
     * Gets query for [[UnidadesEstudios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadesEstudios()
    {
        return $this->hasMany(UnidadesEstudio::class, ['semestres_id' => 'id']);
    }
}
