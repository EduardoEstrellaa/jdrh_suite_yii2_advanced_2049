<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_info_hijos".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $tiene_hijos
 * @property int|null $cantidad_hijos
 *
 * @property Alumnos $alumnos
 * @property EdadesHijos[] $edadesHijos
 */
class AlumInfoHijos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_info_hijos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'tiene_hijos'], 'required'],
            [['alumnos_id', 'tiene_hijos', 'cantidad_hijos'], 'integer'],
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
            'tiene_hijos' => 'Tiene Hijos',
            'cantidad_hijos' => 'Cantidad Hijos',
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
     * Gets query for [[EdadesHijos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEdadesHijos()
    {
        return $this->hasMany(EdadesHijos::class, ['alum_info_hijos_id' => 'id']);
    }
}
