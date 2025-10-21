<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_reacciones_alergicas".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property VariasReaccionesAlergicas[] $variasReaccionesAlergicas
 */
class CatalogoReaccionesAlergicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_reacciones_alergicas';
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
     * Gets query for [[VariasReaccionesAlergicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariasReaccionesAlergicas()
    {
        return $this->hasMany(VariasReaccionesAlergicas::class, ['catalogo_reacciones_alergicas_id' => 'id']);
    }
}
