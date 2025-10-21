<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_lugares_comer".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $catalogo_lugares_comer_id
 * @property string|null $otro_especificar
 *
 * @property Alumnos $alumnos
 * @property CatalogoLugaresComer $catalogoLugaresComer
 */
class AlumLugaresComer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_lugares_comer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'catalogo_lugares_comer_id'], 'required'],
            [['alumnos_id', 'catalogo_lugares_comer_id'], 'integer'],
            [['otro_especificar'], 'string', 'max' => 250],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['catalogo_lugares_comer_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoLugaresComer::class, 'targetAttribute' => ['catalogo_lugares_comer_id' => 'id']],
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
            'catalogo_lugares_comer_id' => 'Catalogo Lugares Comer ID',
            'otro_especificar' => 'Otro Especificar',
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
     * Gets query for [[CatalogoLugaresComer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoLugaresComer()
    {
        return $this->hasOne(CatalogoLugaresComer::class, ['id' => 'catalogo_lugares_comer_id']);
    }
}
