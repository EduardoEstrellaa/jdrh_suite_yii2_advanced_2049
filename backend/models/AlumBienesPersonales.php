<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_bienes_personales".
 *
 * @property int $id
 * @property int $catalogo_bienes_personales_id
 * @property int $alumnos_id
 *
 * @property Alumnos $alumnos
 * @property CatalogoBienesPersonales $catalogoBienesPersonales
 */
class AlumBienesPersonales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_bienes_personales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catalogo_bienes_personales_id', 'alumnos_id'], 'required'],
            [['catalogo_bienes_personales_id', 'alumnos_id'], 'integer'],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['catalogo_bienes_personales_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoBienesPersonales::class, 'targetAttribute' => ['catalogo_bienes_personales_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catalogo_bienes_personales_id' => 'Catalogo Bienes Personales ID',
            'alumnos_id' => 'Alumnos ID',
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
     * Gets query for [[CatalogoBienesPersonales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoBienesPersonales()
    {
        return $this->hasOne(CatalogoBienesPersonales::class, ['id' => 'catalogo_bienes_personales_id']);
    }
}
