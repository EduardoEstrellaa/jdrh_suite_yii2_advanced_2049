<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "varias_reacciones_alergicas".
 *
 * @property int $id
 * @property int $alergias_id
 * @property int $catalogo_reacciones_alergicas_id
 *
 * @property Alergias $alergias
 * @property CatalogoReaccionesAlergicas $catalogoReaccionesAlergicas
 */
class VariasReaccionesAlergicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'varias_reacciones_alergicas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alergias_id', 'catalogo_reacciones_alergicas_id'], 'required'],
            [['alergias_id', 'catalogo_reacciones_alergicas_id'], 'integer'],
            [['alergias_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alergias::class, 'targetAttribute' => ['alergias_id' => 'id']],
            [['catalogo_reacciones_alergicas_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoReaccionesAlergicas::class, 'targetAttribute' => ['catalogo_reacciones_alergicas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alergias_id' => 'Alergias ID',
            'catalogo_reacciones_alergicas_id' => 'Catalogo Reacciones Alergicas ID',
        ];
    }

    /**
     * Gets query for [[Alergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlergias()
    {
        return $this->hasOne(Alergias::class, ['id' => 'alergias_id']);
    }

    /**
     * Gets query for [[CatalogoReaccionesAlergicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoReaccionesAlergicas()
    {
        return $this->hasOne(CatalogoReaccionesAlergicas::class, ['id' => 'catalogo_reacciones_alergicas_id']);
    }
}
