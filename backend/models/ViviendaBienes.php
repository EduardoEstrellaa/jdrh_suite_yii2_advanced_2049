<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vivienda_bienes".
 *
 * @property int $id
 * @property int $alum_vivienda_id
 * @property int $catalogo_bienes_vivienda_id
 * @property string|null $otro_especificar
 *
 * @property AlumVivienda $alumVivienda
 * @property CatalogoBienesVivienda $catalogoBienesVivienda
 */
class ViviendaBienes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vivienda_bienes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alum_vivienda_id', 'catalogo_bienes_vivienda_id'], 'required'],
            [['alum_vivienda_id', 'catalogo_bienes_vivienda_id'], 'integer'],
            [['otro_especificar'], 'string', 'max' => 250],
            [['alum_vivienda_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumVivienda::class, 'targetAttribute' => ['alum_vivienda_id' => 'id']],
            [['catalogo_bienes_vivienda_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoBienesVivienda::class, 'targetAttribute' => ['catalogo_bienes_vivienda_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_vivienda_id' => 'Alum Vivienda ID',
            'catalogo_bienes_vivienda_id' => 'Catalogo Bienes Vivienda ID',
            'otro_especificar' => 'Otro Especificar',
        ];
    }

    /**
     * Gets query for [[AlumVivienda]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumVivienda()
    {
        return $this->hasOne(AlumVivienda::class, ['id' => 'alum_vivienda_id']);
    }

    /**
     * Gets query for [[CatalogoBienesVivienda]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoBienesVivienda()
    {
        return $this->hasOne(CatalogoBienesVivienda::class, ['id' => 'catalogo_bienes_vivienda_id']);
    }
}
