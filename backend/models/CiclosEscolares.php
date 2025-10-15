<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ciclos_escolares".
 *
 * @property int $id
 * @property string $nombre
 * @property string $fecha_inicio
 * @property string $fecha_fin
 *
 * @property AlumInscripciones[] $alumInscripciones
 * @property AsignacionesGrupos[] $asignacionesGrupos
 */
class CiclosEscolares extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ciclos_escolares';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha_inicio', 'fecha_fin'], 'required'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
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
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
        ];
    }

    /**
     * Gets query for [[AlumInscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInscripciones()
    {
        return $this->hasMany(AlumInscripciones::class, ['ciclos_escolares_id' => 'id']);
    }

    /**
     * Gets query for [[AsignacionesGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesGrupos()
    {
        return $this->hasMany(AsignacionesGrupos::class, ['ciclos_escolares_id' => 'id']);
    }
}
