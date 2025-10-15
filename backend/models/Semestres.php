<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "semestres".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property AlumInscripciones[] $alumInscripciones
 * @property AsignacionesGrupos[] $asignacionesGrupos
 * @property PlanSemestres[] $planSemestres
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
            [['nombre', 'descripcion'], 'required'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
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
        ];
    }

    /**
     * Gets query for [[AlumInscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInscripciones()
    {
        return $this->hasMany(AlumInscripciones::class, ['semestre_id' => 'id']);
    }

    /**
     * Gets query for [[AsignacionesGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesGrupos()
    {
        return $this->hasMany(AsignacionesGrupos::class, ['semestres_id' => 'id']);
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
     * Gets query for [[UnidadesEstudios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadesEstudios()
    {
        return $this->hasMany(UnidadesEstudio::class, ['semestres_id' => 'id']);
    }
}
