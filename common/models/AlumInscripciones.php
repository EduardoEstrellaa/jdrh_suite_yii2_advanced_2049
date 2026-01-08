<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alum_inscripciones".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $ciclos_semestres_id
 * @property int $tipos_inscripciones_id
 *
 * @property Alumnos $alumnos
 * @property AsignacionesAlumnosGrupos[] $asignacionesAlumnosGrupos
 * @property CiclosSemestres $ciclosSemestres
 * @property TiposInscripciones $tiposInscripciones
 */
class AlumInscripciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_inscripciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'ciclos_semestres_id', 'tipos_inscripciones_id'], 'required'],
            [['alumnos_id', 'ciclos_semestres_id', 'tipos_inscripciones_id'], 'integer'],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['tipos_inscripciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposInscripciones::class, 'targetAttribute' => ['tipos_inscripciones_id' => 'id']],
            [['ciclos_semestres_id'], 'exist', 'skipOnError' => true, 'targetClass' => CiclosSemestres::class, 'targetAttribute' => ['ciclos_semestres_id' => 'id']],
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
            'ciclos_semestres_id' => 'Ciclos Semestres ID',
            'tipos_inscripciones_id' => 'Tipos Inscripciones ID',
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
     * Gets query for [[AsignacionesAlumnosGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesAlumnosGrupos()
    {
        return $this->hasMany(AsignacionesAlumnosGrupos::class, ['alum_inscripciones_id' => 'id']);
    }

    /**
     * Gets query for [[CiclosSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosSemestres()
    {
        return $this->hasOne(CiclosSemestres::class, ['id' => 'ciclos_semestres_id']);
    }

    /**
     * Gets query for [[TiposInscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiposInscripciones()
    {
        return $this->hasOne(TiposInscripciones::class, ['id' => 'tipos_inscripciones_id']);
    }
}
