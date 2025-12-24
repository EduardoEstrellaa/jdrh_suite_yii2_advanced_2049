<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alum_enfermedades_cronicas".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $padece_enfermedades_cronicas
 *
 * @property Alumnos $alumnos
 * @property EnfermedadesCronicas[] $enfermedadesCronicas
 */
class AlumEnfermedadesCronicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_enfermedades_cronicas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'padece_enfermedades_cronicas'], 'required'],
            [['alumnos_id', 'padece_enfermedades_cronicas'], 'integer'],
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
            'padece_enfermedades_cronicas' => 'Padece Enfermedades Cronicas',
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
     * Gets query for [[EnfermedadesCronicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadesCronicas()
    {
        return $this->hasMany(EnfermedadesCronicas::class, ['alum_enfermedades_cronicas_id' => 'id']);
    }
}
