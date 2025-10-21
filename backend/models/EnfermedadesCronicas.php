<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "enfermedades_cronicas".
 *
 * @property int $id
 * @property int $catalogo_enferm_cronicas_id
 * @property int $alum_enfermedades_cronicas_id
 * @property string|null $otro_especificas
 *
 * @property AlumEnfermedadesCronicas $alumEnfermedadesCronicas
 * @property CatalogoEnfermCronicas $catalogoEnfermCronicas
 */
class EnfermedadesCronicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enfermedades_cronicas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catalogo_enferm_cronicas_id', 'alum_enfermedades_cronicas_id'], 'required'],
            [['catalogo_enferm_cronicas_id', 'alum_enfermedades_cronicas_id'], 'integer'],
            [['otro_especificas'], 'string', 'max' => 250],
            [['alum_enfermedades_cronicas_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumEnfermedadesCronicas::class, 'targetAttribute' => ['alum_enfermedades_cronicas_id' => 'id']],
            [['catalogo_enferm_cronicas_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoEnfermCronicas::class, 'targetAttribute' => ['catalogo_enferm_cronicas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catalogo_enferm_cronicas_id' => 'Catalogo Enferm Cronicas ID',
            'alum_enfermedades_cronicas_id' => 'Alum Enfermedades Cronicas ID',
            'otro_especificas' => 'Otro Especificas',
        ];
    }

    /**
     * Gets query for [[AlumEnfermedadesCronicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumEnfermedadesCronicas()
    {
        return $this->hasOne(AlumEnfermedadesCronicas::class, ['id' => 'alum_enfermedades_cronicas_id']);
    }

    /**
     * Gets query for [[CatalogoEnfermCronicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoEnfermCronicas()
    {
        return $this->hasOne(CatalogoEnfermCronicas::class, ['id' => 'catalogo_enferm_cronicas_id']);
    }
}
