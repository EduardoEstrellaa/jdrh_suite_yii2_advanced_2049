<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
    public const OTRO_ID = 15;

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
     * Obtiene el ID del registro "Otro (especificar)".
     */
    public static function getOtroId(): ?int
    {
        return static::OTRO_ID;
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
