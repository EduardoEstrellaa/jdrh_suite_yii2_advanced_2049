<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "licenciaturas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property PlanLicenciaturas[] $planLicenciaturas
 */
class Licenciaturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licenciaturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
            [['nombre'], 'string', 'max' => 250],
            [['descripcion'], 'string', 'max' => 800],
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
        return $this->hasMany(PlanLicenciaturas::class, ['licenciaturas_id' => 'id']);
    }
}
