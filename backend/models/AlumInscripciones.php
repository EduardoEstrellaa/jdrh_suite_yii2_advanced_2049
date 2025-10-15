<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_inscripciones".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $tipos_inscripciones_id
 * @property int $semestre_id
 * @property int $ciclos_escolares_id
 *
 * @property Alumnos $alumnos
 * @property AsignacionesAlumnosGrupos[] $asignacionesAlumnosGrupos
 * @property CiclosEscolares $ciclosEscolares
 * @property Semestres $semestre
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
            [['alumnos_id', 'tipos_inscripciones_id', 'semestre_id', 'ciclos_escolares_id'], 'required'],
            [['alumnos_id', 'tipos_inscripciones_id', 'semestre_id', 'ciclos_escolares_id'], 'integer'],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['ciclos_escolares_id'], 'exist', 'skipOnError' => true, 'targetClass' => CiclosEscolares::class, 'targetAttribute' => ['ciclos_escolares_id' => 'id']],
            [['tipos_inscripciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposInscripciones::class, 'targetAttribute' => ['tipos_inscripciones_id' => 'id']],
            [['semestre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semestres::class, 'targetAttribute' => ['semestre_id' => 'id']],
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
            'tipos_inscripciones_id' => 'Tipos Inscripciones ID',
            'semestre_id' => 'Semestre ID',
            'ciclos_escolares_id' => 'Ciclos Escolares ID',
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
     * Gets query for [[CiclosEscolares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosEscolares()
    {
        return $this->hasOne(CiclosEscolares::class, ['id' => 'ciclos_escolares_id']);
    }

    /**
     * Gets query for [[Semestre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestre()
    {
        return $this->hasOne(Semestres::class, ['id' => 'semestre_id']);
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
