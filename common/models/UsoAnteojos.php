<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uso_anteojos".
 *
 * @property int $id
 * @property int $alum_uso_anteojos_id
 * @property int $catalogo_uso_anteojos_id
 *
 * @property AlumUsoAnteojos $alumUsoAnteojos
 * @property CatalogoUsoAnteojos $catalogoUsoAnteojos
 */
class UsoAnteojos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uso_anteojos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alum_uso_anteojos_id', 'catalogo_uso_anteojos_id'], 'required'],
            [['alum_uso_anteojos_id', 'catalogo_uso_anteojos_id'], 'integer'],
            [['alum_uso_anteojos_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumUsoAnteojos::class, 'targetAttribute' => ['alum_uso_anteojos_id' => 'id']],
            [['catalogo_uso_anteojos_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoUsoAnteojos::class, 'targetAttribute' => ['catalogo_uso_anteojos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_uso_anteojos_id' => 'Alum Uso Anteojos ID',
            'catalogo_uso_anteojos_id' => 'Catalogo Uso Anteojos ID',
        ];
    }

    /**
     * Gets query for [[AlumUsoAnteojos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumUsoAnteojos()
    {
        return $this->hasOne(AlumUsoAnteojos::class, ['id' => 'alum_uso_anteojos_id']);
    }

    /**
     * Gets query for [[CatalogoUsoAnteojos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoUsoAnteojos()
    {
        return $this->hasOne(CatalogoUsoAnteojos::class, ['id' => 'catalogo_uso_anteojos_id']);
    }
}
