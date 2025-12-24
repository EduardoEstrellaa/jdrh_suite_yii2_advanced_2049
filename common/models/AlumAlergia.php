<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alum_alergia".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $padeces_alergias
 *
 * @property Alergias[] $alergias
 * @property Alumnos $alumnos
 */
class AlumAlergia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_alergia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'padeces_alergias'], 'required'],
            [['alumnos_id', 'padeces_alergias'], 'integer'],
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
            'padeces_alergias' => 'Padeces Alergias',
        ];
    }

    /**
     * Gets query for [[Alergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlergias()
    {
        return $this->hasMany(Alergias::class, ['alum_alergia_id' => 'id']);
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
}
