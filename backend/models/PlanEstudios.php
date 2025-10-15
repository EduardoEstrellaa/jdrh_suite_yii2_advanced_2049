<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plan_estudios".
 *
 * @property int $id
 * @property string $nombre
 * @property int $anio
 * @property string $descripcion
 *
 * @property PlanLicenciaturas[] $planLicenciaturas
 */
class PlanEstudios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_estudios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'anio', 'descripcion'], 'required'],
            [['anio'], 'integer'],
            [['nombre', 'descripcion'], 'string', 'max' => 250],
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
            'anio' => 'Anio',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[PlanLicenciaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanLicenciaturas()
    {
        return $this->hasMany(PlanLicenciaturas::class, ['plan_estudios_id' => 'id']);
    }
}
