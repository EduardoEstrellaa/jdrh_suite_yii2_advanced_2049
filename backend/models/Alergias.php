<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alergias".
 *
 * @property int $id
 * @property int $alum_alergia_id
 * @property int $catalogo_alergias_id
 * @property int $tipo_gravedad_id
 *
 * @property AlumAlergia $alumAlergia
 * @property CatalogoAlergias $catalogoAlergias
 * @property TipoGravedad $tipoGravedad
 * @property VariasReaccionesAlergicas[] $variasReaccionesAlergicas
 */
class Alergias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alergias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_alergia_id', 'catalogo_alergias_id', 'tipo_gravedad_id'], 'required'],
            [['id', 'alum_alergia_id', 'catalogo_alergias_id', 'tipo_gravedad_id'], 'integer'],
            [['id'], 'unique'],
            [['alum_alergia_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumAlergia::class, 'targetAttribute' => ['alum_alergia_id' => 'id']],
            [['catalogo_alergias_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoAlergias::class, 'targetAttribute' => ['catalogo_alergias_id' => 'id']],
            [['tipo_gravedad_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoGravedad::class, 'targetAttribute' => ['tipo_gravedad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_alergia_id' => 'Alum Alergia ID',
            'catalogo_alergias_id' => 'Catalogo Alergias ID',
            'tipo_gravedad_id' => 'Tipo Gravedad ID',
        ];
    }

    /**
     * Gets query for [[AlumAlergia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumAlergia()
    {
        return $this->hasOne(AlumAlergia::class, ['id' => 'alum_alergia_id']);
    }

    /**
     * Gets query for [[CatalogoAlergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoAlergias()
    {
        return $this->hasOne(CatalogoAlergias::class, ['id' => 'catalogo_alergias_id']);
    }

    /**
     * Gets query for [[TipoGravedad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoGravedad()
    {
        return $this->hasOne(TipoGravedad::class, ['id' => 'tipo_gravedad_id']);
    }

    /**
     * Gets query for [[VariasReaccionesAlergicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariasReaccionesAlergicas()
    {
        return $this->hasMany(VariasReaccionesAlergicas::class, ['alergias_id' => 'id']);
    }
}
