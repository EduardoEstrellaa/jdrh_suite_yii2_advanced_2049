<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_depende_economicamente".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $catalogo_dependencias_economicas_id
 * @property string|null $otro_especificar
 *
 * @property Alumnos $alumnos
 * @property CatalogoDependenciasEconomicas $catalogoDependenciasEconomicas
 */
class AlumDependeEconomicamente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_depende_economicamente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'catalogo_dependencias_economicas_id'], 'required'],
            [['alumnos_id', 'catalogo_dependencias_economicas_id'], 'integer'],
            [['otro_especificar'], 'string', 'max' => 250],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['catalogo_dependencias_economicas_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoDependenciasEconomicas::class, 'targetAttribute' => ['catalogo_dependencias_economicas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alumnos_id' => 'Alumnos ID',
            'catalogo_dependencias_economicas_id' => 'Catalogo Dependencias Economicas ID',
            'otro_especificar' => 'Otro Especificar',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasOne(Alumnos::class, ['id' => 'alumnos_id']);
    }

    /**
     * Gets query for [[CatalogoDependenciasEconomicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoDependenciasEconomicas()
    {
        return $this->hasOne(CatalogoDependenciasEconomicas::class, ['id' => 'catalogo_dependencias_economicas_id']);
    }
}
