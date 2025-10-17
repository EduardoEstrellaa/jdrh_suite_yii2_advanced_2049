<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_dependen_economica".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $tiene_dependientes
 *
 * @property Alumnos $alumnos
 * @property Dependientes[] $dependientes
 */
class AlumDependenEconomica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_dependen_economica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'tiene_dependientes'], 'required'],
            [['alumnos_id', 'tiene_dependientes'], 'integer'],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
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
            'tiene_dependientes' => 'Tiene Dependientes',
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
     * Gets query for [[Dependientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDependientes()
    {
        return $this->hasMany(Dependientes::class, ['alum_dependen_economica_id' => 'id']);
    }
}
