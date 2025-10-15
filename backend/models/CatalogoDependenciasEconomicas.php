<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catalogo_dependencias_economicas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $categorias_dependencias_id
 *
 * @property AlumDependeEconomicamente[] $alumDependeEconomicamentes
 * @property CategoriasDependencias $categoriasDependencias
 * @property Dependientes[] $dependientes
 */
class CatalogoDependenciasEconomicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_dependencias_economicas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'categorias_dependencias_id'], 'required'],
            [['categorias_dependencias_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
            [['categorias_dependencias_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriasDependencias::class, 'targetAttribute' => ['categorias_dependencias_id' => 'id']],
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
            'categorias_dependencias_id' => 'Categorias Dependencias ID',
        ];
    }

    /**
     * Gets query for [[AlumDependeEconomicamentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumDependeEconomicamentes()
    {
        return $this->hasMany(AlumDependeEconomicamente::class, ['catalogo_dependencias_economicas_id' => 'id']);
    }

    /**
     * Gets query for [[CategoriasDependencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriasDependencias()
    {
        return $this->hasOne(CategoriasDependencias::class, ['id' => 'categorias_dependencias_id']);
    }

    /**
     * Gets query for [[Dependientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDependientes()
    {
        return $this->hasMany(Dependientes::class, ['catalogo_dependencias_economicas_id' => 'id']);
    }
}
