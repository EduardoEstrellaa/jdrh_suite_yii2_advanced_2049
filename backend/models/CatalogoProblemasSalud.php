<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_problemas_salud".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property ProblemasSalud[] $problemasSaluds
 */
class CatalogoProblemasSalud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_problemas_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
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
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[ProblemasSaluds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProblemasSaluds()
    {
        return $this->hasMany(ProblemasSalud::class, ['catalogo_problemas_salud_id' => 'id']);
    }
}
