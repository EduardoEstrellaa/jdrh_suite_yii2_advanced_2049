<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "asignaciones_grupos".
 *
 * @property int $id
 * @property int $semestres_id
 * @property int $ciclos_escolares_id
 * @property int $grupos_id
 * @property int $asignaciones_tutores_id
 *
 * @property AsignacionesAlumnosGrupos[] $asignacionesAlumnosGrupos
 * @property AsignacionesTutores $asignacionesTutores
 * @property CiclosEscolares $ciclosEscolares
 * @property Grupos $grupos
 * @property Semestres $semestres
 */
class AsignacionesGrupos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignaciones_grupos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['semestres_id', 'ciclos_escolares_id', 'grupos_id', 'asignaciones_tutores_id'], 'required'],
            [['semestres_id', 'ciclos_escolares_id', 'grupos_id', 'asignaciones_tutores_id'], 'integer'],
            [['asignaciones_tutores_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsignacionesTutores::class, 'targetAttribute' => ['asignaciones_tutores_id' => 'id']],
            [['ciclos_escolares_id'], 'exist', 'skipOnError' => true, 'targetClass' => CiclosEscolares::class, 'targetAttribute' => ['ciclos_escolares_id' => 'id']],
            [['grupos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grupos::class, 'targetAttribute' => ['grupos_id' => 'id']],
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
            'ciclos_escolares_id' => 'Ciclos Escolares ID',
            'grupos_id' => 'Grupos ID',
            'asignaciones_tutores_id' => 'Asignaciones Tutores ID',
        ];
    }

    /**
     * Gets query for [[AsignacionesAlumnosGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesAlumnosGrupos()
    {
        return $this->hasMany(AsignacionesAlumnosGrupos::class, ['asignaciones_grupos_id' => 'id']);
    }

    /**
     * Gets query for [[AsignacionesTutores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesTutores()
    {
        return $this->hasOne(AsignacionesTutores::class, ['id' => 'asignaciones_tutores_id']);
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
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasOne(Grupos::class, ['id' => 'grupos_id']);
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
