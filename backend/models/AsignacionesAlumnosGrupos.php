<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "asignaciones_alumnos_grupos".
 *
 * @property int $id
 * @property int $asignaciones_grupos_id
 * @property int $alum_inscripciones_id
 *
 * @property AlumInscripciones $alumInscripciones
 * @property AsignacionesGrupos $asignacionesGrupos
 */
class AsignacionesAlumnosGrupos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignaciones_alumnos_grupos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'asignaciones_grupos_id', 'alum_inscripciones_id'], 'required'],
            [['id', 'asignaciones_grupos_id', 'alum_inscripciones_id'], 'integer'],
            [['id'], 'unique'],
            [['alum_inscripciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumInscripciones::class, 'targetAttribute' => ['alum_inscripciones_id' => 'id']],
            [['asignaciones_grupos_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsignacionesGrupos::class, 'targetAttribute' => ['asignaciones_grupos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asignaciones_grupos_id' => 'Asignaciones Grupos ID',
            'alum_inscripciones_id' => 'Alum Inscripciones ID',
        ];
    }

    /**
     * Gets query for [[AlumInscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInscripciones()
    {
        return $this->hasOne(AlumInscripciones::class, ['id' => 'alum_inscripciones_id']);
    }

    /**
     * Gets query for [[AsignacionesGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesGrupos()
    {
        return $this->hasOne(AsignacionesGrupos::class, ['id' => 'asignaciones_grupos_id']);
    }
}
