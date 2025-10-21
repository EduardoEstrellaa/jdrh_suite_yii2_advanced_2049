<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "organizaciones".
 *
 * @property int $id
 * @property int $alum_organizacion_id
 * @property int $catalogo_organizaciones_id
 * @property string|null $otra_organizacion_especificar
 *
 * @property AlumOrganizacion $alumOrganizacion
 * @property CatalogoOrganizaciones $catalogoOrganizaciones
 */
class Organizaciones extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organizaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['otra_organizacion_especificar'], 'default', 'value' => null],
            [['alum_organizacion_id', 'catalogo_organizaciones_id'], 'required'],
            [['alum_organizacion_id', 'catalogo_organizaciones_id'], 'integer'],
            [['otra_organizacion_especificar'], 'string', 'max' => 250],
            [['alum_organizacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumOrganizacion::class, 'targetAttribute' => ['alum_organizacion_id' => 'id']],
            [['catalogo_organizaciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoOrganizaciones::class, 'targetAttribute' => ['catalogo_organizaciones_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_organizacion_id' => 'Alum Organizacion ID',
            'catalogo_organizaciones_id' => 'Catalogo Organizaciones ID',
            'otra_organizacion_especificar' => 'Otra Organizacion Especificar',
        ];
    }

    /**
     * Gets query for [[AlumOrganizacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumOrganizacion()
    {
        return $this->hasOne(AlumOrganizacion::class, ['id' => 'alum_organizacion_id']);
    }

    /**
     * Gets query for [[CatalogoOrganizaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoOrganizaciones()
    {
        return $this->hasOne(CatalogoOrganizaciones::class, ['id' => 'catalogo_organizaciones_id']);
    }

}
