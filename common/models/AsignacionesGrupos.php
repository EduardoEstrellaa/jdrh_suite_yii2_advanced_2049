<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asignaciones_grupos".
 *
 * @property int $id
 * @property int $ciclos_semestres_id
 * @property int $grupos_id
 * @property int $asignaciones_tutores_id
 *
 * @property AsignacionesAlumnosGrupos[] $asignacionesAlumnosGrupos
 * @property AsignacionesTutores $asignacionesTutores
 * @property CiclosSemestres $ciclosSemestres
 * @property Grupos $grupos
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
            [['ciclos_semestres_id', 'grupos_id', 'asignaciones_tutores_id'], 'required'],
            [['ciclos_semestres_id', 'grupos_id', 'asignaciones_tutores_id'], 'integer'],
            [['asignaciones_tutores_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsignacionesTutores::class, 'targetAttribute' => ['asignaciones_tutores_id' => 'id']],
            [['grupos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grupos::class, 'targetAttribute' => ['grupos_id' => 'id']],
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
            'ciclos_semestres_id' => 'Ciclos Semestres ID',
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
     * Gets query for [[CiclosSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosSemestres()
    {
        return $this->hasOne(CiclosSemestres::class, ['id' => 'ciclos_semestres_id']);
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
}
