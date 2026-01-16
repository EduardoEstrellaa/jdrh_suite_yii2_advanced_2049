<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalogo_lugares_comer".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property AlumLugaresComer[] $alumLugaresComers
 */
class CatalogoLugaresComer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_lugares_comer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 150],
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
            ->where(['like', 'nombre', 'Otro (especificar)', false])
            ->orderBy(['id' => SORT_ASC])
            ->one();

        return $record ? (int)$record->id : null;
    }

    /**
     * Gets query for [[AlumLugaresComers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumLugaresComers()
    {
        return $this->hasMany(AlumLugaresComer::class, ['catalogo_lugares_comer_id' => 'id']);
    }
}
