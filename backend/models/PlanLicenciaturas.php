<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plan_licenciaturas".
 *
 * @property int $id
 * @property int $plan_estudios_id
 * @property int $licenciaturas_id
 *
 * @property Alumnos[] $alumnos
 * @property Licenciaturas $licenciaturas
 * @property PlanEstudios $planEstudios
 * @property PlanSemestres[] $planSemestres
 */
class PlanLicenciaturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_licenciaturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_estudios_id', 'licenciaturas_id'], 'required'],
            [['plan_estudios_id', 'licenciaturas_id'], 'integer'],
            [['licenciaturas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Licenciaturas::class, 'targetAttribute' => ['licenciaturas_id' => 'id']],
            [['plan_estudios_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanEstudios::class, 'targetAttribute' => ['plan_estudios_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_estudios_id' => 'Plan Estudios ID',
            'licenciaturas_id' => 'Licenciaturas ID',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::class, ['plan_licenciaturas_id' => 'id']);
    }

    /**
     * Gets query for [[Licenciaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLicenciaturas()
    {
        return $this->hasOne(Licenciaturas::class, ['id' => 'licenciaturas_id']);
    }

    /**
     * Gets query for [[PlanEstudios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanEstudios()
    {
        return $this->hasOne(PlanEstudios::class, ['id' => 'plan_estudios_id']);
    }

    /**
     * Gets query for [[PlanSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanSemestres()
    {
        return $this->hasMany(PlanSemestres::class, ['plan_licenciatura_id' => 'id']);
    }
}
