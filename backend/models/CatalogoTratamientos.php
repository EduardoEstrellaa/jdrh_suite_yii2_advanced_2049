<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_tratamientos".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $tipos_tratamientos_id
 *
 * @property TiposTratamientos $tiposTratamientos
 * @property Tratamientos[] $tratamientos
 */
class CatalogoTratamientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_tratamientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre', 'tipos_tratamientos_id'], 'required'],
            [['id', 'tipos_tratamientos_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
            [['id'], 'unique'],
            [['tipos_tratamientos_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposTratamientos::class, 'targetAttribute' => ['tipos_tratamientos_id' => 'id']],
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
            'tipos_tratamientos_id' => 'Tipos Tratamientos ID',
        ];
    }

    /**
     * Gets query for [[TiposTratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiposTratamientos()
    {
        return $this->hasOne(TiposTratamientos::class, ['id' => 'tipos_tratamientos_id']);
    }

    /**
     * Gets query for [[Tratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamientos::class, ['catalogo_tratamientos_id' => 'id']);
    }
}
