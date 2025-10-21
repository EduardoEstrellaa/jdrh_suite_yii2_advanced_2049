<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipo_organizacion".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property CatalogoOrganizaciones[] $catalogoOrganizaciones
 */
class TipoOrganizacion extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_organizacion';
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
     * Gets query for [[CatalogoOrganizaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoOrganizaciones()
    {
        return $this->hasMany(CatalogoOrganizaciones::class, ['tipo_organizacion_id' => 'id']);
    }

}
