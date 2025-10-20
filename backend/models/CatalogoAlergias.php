<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_alergias".
 *
 * @property int $id
 * @property string $nombre
 * @property int $tipo_alergias_id
 *
 * @property Alergias[] $alergias
 * @property TipoAlergias $tipoAlergias
 */
class CatalogoAlergias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_alergias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'tipo_alergias_id'], 'required'],
            [['tipo_alergias_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['tipo_alergias_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAlergias::class, 'targetAttribute' => ['tipo_alergias_id' => 'id']],
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
            'tipo_alergias_id' => 'Tipo Alergias ID',
        ];
    }

    /**
     * Gets query for [[Alergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlergias()
    {
        return $this->hasMany(Alergias::class, ['catalogo_alergias_id' => 'id']);
    }

    /**
     * Gets query for [[TipoAlergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAlergias()
    {
        return $this->hasOne(TipoAlergias::class, ['id' => 'tipo_alergias_id']);
    }
}
