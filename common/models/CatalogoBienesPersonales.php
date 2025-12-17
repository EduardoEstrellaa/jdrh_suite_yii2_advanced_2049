<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalogo_bienes_personales".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property AlumBienesPersonales[] $alumBienesPersonales
 */
class CatalogoBienesPersonales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_bienes_personales';
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
     * Opciones para dropdown o checkboxes (id => nombre).
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
     * Gets query for [[AlumBienesPersonales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumBienesPersonales()
    {
        return $this->hasMany(AlumBienesPersonales::class, ['catalogo_bienes_personales_id' => 'id']);
    }
}
