<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalogo_enferm_cronicas".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property EnfermedadesCronicas[] $enfermedadesCronicas
 */
class CatalogoEnfermCronicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_enferm_cronicas';
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
     * Identificador del registro "Otro" si existe.
     */
    public static function getOtroId(): ?int
    {
        $record = static::find()
            ->select('id')
            ->where(['like', 'nombre', 'otro', false])
            ->orderBy(['id' => SORT_ASC])
            ->one();

        return $record ? (int)$record->id : null;
    }

    /**
     * Gets query for [[EnfermedadesCronicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadesCronicas()
    {
        return $this->hasMany(EnfermedadesCronicas::class, ['catalogo_enferm_cronicas_id' => 'id']);
    }
}
