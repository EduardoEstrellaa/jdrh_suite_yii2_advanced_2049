<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plan_semestres".
 *
 * @property int $id
 * @property int $plan_licenciatura_id
 * @property int $semestres_id
 * @property int $unidades_estudio_id
 *
 * @property PlanLicenciaturas $planLicenciatura
 * @property Semestres $semestres
 * @property UnidadesEstudio $unidadesEstudio
 */
class PlanSemestres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_semestres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_licenciatura_id', 'semestres_id', 'unidades_estudio_id'], 'required'],
            [['plan_licenciatura_id', 'semestres_id', 'unidades_estudio_id'], 'integer'],
            [['plan_licenciatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanLicenciaturas::class, 'targetAttribute' => ['plan_licenciatura_id' => 'id']],
            [['semestres_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semestres::class, 'targetAttribute' => ['semestres_id' => 'id']],
            [['unidades_estudio_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadesEstudio::class, 'targetAttribute' => ['unidades_estudio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_licenciatura_id' => 'Plan Licenciatura ID',
            'semestres_id' => 'Semestres ID',
            'unidades_estudio_id' => 'Unidades Estudio ID',
        ];
    }

    /**
     * Gets query for [[PlanLicenciatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanLicenciatura()
    {
        return $this->hasOne(PlanLicenciaturas::class, ['id' => 'plan_licenciatura_id']);
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

    /**
     * Gets query for [[UnidadesEstudio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadesEstudio()
    {
        return $this->hasOne(UnidadesEstudio::class, ['id' => 'unidades_estudio_id']);
    }
}
