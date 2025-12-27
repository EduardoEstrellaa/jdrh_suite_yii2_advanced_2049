<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalogo_usos_internet".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property UsosInternet[] $usosInternets
 */
class CatalogoUsosInternet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_usos_internet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 250],
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
     * Gets query for [[UsosInternets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsosInternets()
    {
        return $this->hasMany(UsosInternet::class, ['catalogo_usos_internet_id' => 'id']);
    }
}
