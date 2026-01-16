<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deportes".
 *
 * @property int $id
 * @property int $alum_deportes_id
 * @property int $catalogo_deportes_id
 *
 * @property AlumDeportes $alumDeportes
 * @property CatalogoDeportes $catalogoDeportes
 */
class Deportes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deportes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alum_deportes_id', 'catalogo_deportes_id'], 'required'],
            [['alum_deportes_id', 'catalogo_deportes_id'], 'integer'],
            [['alum_deportes_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumDeportes::class, 'targetAttribute' => ['alum_deportes_id' => 'id']],
            [['catalogo_deportes_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoDeportes::class, 'targetAttribute' => ['catalogo_deportes_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_deportes_id' => 'Alum Deportes ID',
            'catalogo_deportes_id' => 'Catalogo Deportes ID',
        ];
    }

    /**
     * Gets query for [[AlumDeportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumDeportes()
    {
        return $this->hasOne(AlumDeportes::class, ['id' => 'alum_deportes_id']);
    }

    /**
     * Gets query for [[CatalogoDeportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoDeportes()
    {
        return $this->hasOne(CatalogoDeportes::class, ['id' => 'catalogo_deportes_id']);
    }
}
