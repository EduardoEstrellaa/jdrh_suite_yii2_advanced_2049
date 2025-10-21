<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_uso_anteojos".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $utilizas_anteojos
 *
 * @property Alumnos $alumnos
 * @property UsoAnteojos[] $usoAnteojos
 */
class AlumUsoAnteojos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_uso_anteojos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'utilizas_anteojos'], 'required'],
            [['alumnos_id', 'utilizas_anteojos'], 'integer'],
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
            'utilizas_anteojos' => 'Utilizas Anteojos',
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
     * Gets query for [[UsoAnteojos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsoAnteojos()
    {
        return $this->hasMany(UsoAnteojos::class, ['alum_uso_anteojos_id' => 'id']);
    }
}
