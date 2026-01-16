<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usos_internet".
 *
 * @property int $id
 * @property int $alum_recreacion_tiempo_id
 * @property int $catalogo_usos_internet_id
 *
 * @property AlumRecreacionTiempo $alumRecreacionTiempo
 * @property CatalogoUsosInternet $catalogoUsosInternet
 */
class UsosInternet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usos_internet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alum_recreacion_tiempo_id', 'catalogo_usos_internet_id'], 'required'],
            [['alum_recreacion_tiempo_id', 'catalogo_usos_internet_id'], 'integer'],
            [['alum_recreacion_tiempo_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumRecreacionTiempo::class, 'targetAttribute' => ['alum_recreacion_tiempo_id' => 'id']],
            [['catalogo_usos_internet_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoUsosInternet::class, 'targetAttribute' => ['catalogo_usos_internet_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_recreacion_tiempo_id' => 'Alum Recreacion Tiempo ID',
            'catalogo_usos_internet_id' => 'Catalogo Usos Internet ID',
        ];
    }

    /**
     * Gets query for [[AlumRecreacionTiempo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumRecreacionTiempo()
    {
        return $this->hasOne(AlumRecreacionTiempo::class, ['id' => 'alum_recreacion_tiempo_id']);
    }

    /**
     * Gets query for [[CatalogoUsosInternet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoUsosInternet()
    {
        return $this->hasOne(CatalogoUsosInternet::class, ['id' => 'catalogo_usos_internet_id']);
    }
}
