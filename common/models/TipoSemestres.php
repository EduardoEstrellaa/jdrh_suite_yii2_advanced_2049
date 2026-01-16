<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_semestres".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Semestres[] $semestres
 */
class TipoSemestres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_semestres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 150],
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
        ];
    }

    /**
     * Gets query for [[Semestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestres()
    {
        return $this->hasMany(Semestres::class, ['tipo_semestres_id' => 'id']);
    }
}
