<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "asignaciones_tutores".
 *
 * @property int $id
 * @property int $perfil_id
 *
 * @property AsignacionesGrupos[] $asignacionesGrupos
 * @property Perfil $perfil
 */
class AsignacionesTutores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignaciones_tutores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perfil_id'], 'required'],
            [['perfil_id'], 'integer'],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::class, 'targetAttribute' => ['perfil_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perfil_id' => 'Perfil ID',
        ];
    }

    /**
     * Gets query for [[AsignacionesGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesGrupos()
    {
        return $this->hasMany(AsignacionesGrupos::class, ['asignaciones_tutores_id' => 'id']);
    }

    /**
     * Gets query for [[Perfil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfil::class, ['id' => 'perfil_id']);
    }
}
