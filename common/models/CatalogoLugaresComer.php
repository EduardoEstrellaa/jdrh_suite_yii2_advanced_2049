<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalogo_lugares_comer".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property AlumLugaresComer[] $alumLugaresComers
 */
class CatalogoLugaresComer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_lugares_comer';
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
     * Gets query for [[AlumLugaresComers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumLugaresComers()
    {
        return $this->hasMany(AlumLugaresComer::class, ['catalogo_lugares_comer_id' => 'id']);
    }
}
