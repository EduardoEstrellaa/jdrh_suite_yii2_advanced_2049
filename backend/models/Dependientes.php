<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dependientes".
 *
 * @property int $id
 * @property int $alum_dependen_economica_id
 * @property int $catalogo_dependencias_economicas_id
 * @property string|null $otro_especificar
 *
 * @property AlumDependenEconomica $alumDependenEconomica
 * @property CatalogoDependenciasEconomicas $catalogoDependenciasEconomicas
 */
class Dependientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dependientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_dependen_economica_id', 'catalogo_dependencias_economicas_id'], 'required'],
            [['id', 'alum_dependen_economica_id', 'catalogo_dependencias_economicas_id'], 'integer'],
            [['otro_especificar'], 'string', 'max' => 250],
            [['id'], 'unique'],
            [['alum_dependen_economica_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumDependenEconomica::class, 'targetAttribute' => ['alum_dependen_economica_id' => 'id']],
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
            'alum_dependen_economica_id' => 'Alum Dependen Economica ID',
            'catalogo_dependencias_economicas_id' => 'Catalogo Dependencias Economicas ID',
            'otro_especificar' => 'Otro Especificar',
        ];
    }

    /**
     * Gets query for [[AlumDependenEconomica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumDependenEconomica()
    {
        return $this->hasOne(AlumDependenEconomica::class, ['id' => 'alum_dependen_economica_id']);
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
