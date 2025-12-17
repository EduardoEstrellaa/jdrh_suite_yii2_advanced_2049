<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicios_salud".
 *
 * @property int $id
 * @property int $alum_servicios_salud_id
 * @property int $catalogo_servicios_salud_id
 *
 * @property AlumServiciosSalud $alumServiciosSalud
 * @property CatalogoServiciosSalud $catalogoServiciosSalud
 */
class ServiciosSalud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicios_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alum_servicios_salud_id', 'catalogo_servicios_salud_id'], 'required'],
            [['alum_servicios_salud_id', 'catalogo_servicios_salud_id'], 'integer'],
            [['alum_servicios_salud_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumServiciosSalud::class, 'targetAttribute' => ['alum_servicios_salud_id' => 'id']],
            [['catalogo_servicios_salud_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoServiciosSalud::class, 'targetAttribute' => ['catalogo_servicios_salud_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_servicios_salud_id' => 'Alum Servicios Salud ID',
            'catalogo_servicios_salud_id' => 'Catalogo Servicios Salud ID',
        ];
    }

    /**
     * Gets query for [[AlumServiciosSalud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumServiciosSalud()
    {
        return $this->hasOne(AlumServiciosSalud::class, ['id' => 'alum_servicios_salud_id']);
    }

    /**
     * Gets query for [[CatalogoServiciosSalud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoServiciosSalud()
    {
        return $this->hasOne(CatalogoServiciosSalud::class, ['id' => 'catalogo_servicios_salud_id']);
    }
}
