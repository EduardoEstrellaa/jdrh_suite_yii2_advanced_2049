<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalogo_alimentos".
 *
 * @property int $id
 * @property string $nombre
 * @property int $categorias_catalogo_alimentos_id
 *
 * @property AlumConsumoAlimentos[] $alumConsumoAlimentos
 * @property CategoriasCatalogoAlimentos $categoriasCatalogoAlimentos
 */
class CatalogoAlimentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_alimentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'categorias_catalogo_alimentos_id'], 'required'],
            [['categorias_catalogo_alimentos_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['categorias_catalogo_alimentos_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriasCatalogoAlimentos::class, 'targetAttribute' => ['categorias_catalogo_alimentos_id' => 'id']],
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
            'categorias_catalogo_alimentos_id' => 'Categorias Catalogo Alimentos ID',
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
     * Gets query for [[AlumConsumoAlimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumConsumoAlimentos()
    {
        return $this->hasMany(AlumConsumoAlimentos::class, ['catalogo_alimentos_id' => 'id']);
    }

    /**
     * Gets query for [[CategoriasCatalogoAlimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriasCatalogoAlimentos()
    {
        return $this->hasOne(CategoriasCatalogoAlimentos::class, ['id' => 'categorias_catalogo_alimentos_id']);
    }
}
