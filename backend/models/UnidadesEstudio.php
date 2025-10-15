<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "unidades_estudio".
 *
 * @property int $id
 * @property int $semestres_id
 * @property string $nombre
 * @property string $descripcion_general
 * @property float $creditos
 * @property int $horas_semana
 * @property int $horas_semestre
 *
 * @property PlanSemestres[] $planSemestres
 * @property Semestres $semestres
 */
class UnidadesEstudio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidades_estudio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['semestres_id', 'nombre', 'descripcion_general', 'creditos', 'horas_semana', 'horas_semestre'], 'required'],
            [['semestres_id', 'horas_semana', 'horas_semestre'], 'integer'],
            [['creditos'], 'number'],
            [['nombre'], 'string', 'max' => 250],
            [['descripcion_general'], 'string', 'max' => 1000],
            [['semestres_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semestres::class, 'targetAttribute' => ['semestres_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'semestres_id' => 'Semestres ID',
            'nombre' => 'Nombre',
            'descripcion_general' => 'Descripcion General',
            'creditos' => 'Creditos',
            'horas_semana' => 'Horas Semana',
            'horas_semestre' => 'Horas Semestre',
        ];
    }

    /**
     * Gets query for [[PlanSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanSemestres()
    {
        return $this->hasMany(PlanSemestres::class, ['unidades_estudio_id' => 'id']);
    }

    /**
     * Gets query for [[Semestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestres()
    {
        return $this->hasOne(Semestres::class, ['id' => 'semestres_id']);
    }
}
