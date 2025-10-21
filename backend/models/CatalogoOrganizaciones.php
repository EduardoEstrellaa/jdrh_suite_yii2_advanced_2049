<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_organizaciones".
 *
 * @property int $id
 * @property string $nombre
 * @property int $tipo_organizacion_id
 *
 * @property Organizaciones[] $organizaciones
 * @property TipoOrganizacion $tipoOrganizacion
 */
class CatalogoOrganizaciones extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_organizaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'tipo_organizacion_id'], 'required'],
            [['tipo_organizacion_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['tipo_organizacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoOrganizacion::class, 'targetAttribute' => ['tipo_organizacion_id' => 'id']],
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
            'tipo_organizacion_id' => 'Tipo Organizacion ID',
        ];
    }

    /**
     * Gets query for [[Organizaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizaciones()
    {
        return $this->hasMany(Organizaciones::class, ['catalogo_organizaciones_id' => 'id']);
    }

    /**
     * Gets query for [[TipoOrganizacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoOrganizacion()
    {
        return $this->hasOne(TipoOrganizacion::class, ['id' => 'tipo_organizacion_id']);
    }

}
