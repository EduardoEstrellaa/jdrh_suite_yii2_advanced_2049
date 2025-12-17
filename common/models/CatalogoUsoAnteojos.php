<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalogo_uso_anteojos".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property UsoAnteojos[] $usoAnteojos
 */
class CatalogoUsoAnteojos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_uso_anteojos';
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
     * Opciones para dropdown (id => nombre).
     */
    public static function dropdownOptions(): array
    {
        $records = static::find()
            ->select(['id', 'nombre'])
            ->orderBy(['nombre' => SORT_ASC])
            ->asArray()
            ->all();

        return ArrayHelper::map($records, 'id', 'nombre');
    }

    /**
     * Gets query for [[UsoAnteojos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsoAnteojos()
    {
        return $this->hasMany(UsoAnteojos::class, ['catalogo_uso_anteojos_id' => 'id']);
    }
}
