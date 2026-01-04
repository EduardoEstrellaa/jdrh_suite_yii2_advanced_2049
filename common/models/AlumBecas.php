<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alum_becas".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $tiene_beca
 * @property int|null $tipos_becas_id
 * @property string|null $otro_especificar
 *
 * @property Alumnos $alumnos
 * @property TiposBecas $tiposBecas
 */
class AlumBecas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_becas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'tiene_beca'], 'required'],
            [['alumnos_id', 'tiene_beca', 'tipos_becas_id'], 'integer'],
            [['otro_especificar'], 'string', 'max' => 250],
            [
                'tipos_becas_id',
                'required',
                'when' => function ($model) {
                    return (int)$model->tiene_beca === 1;
                },
                'whenClient' => "function(){ return $('#alumbecas-tiene_beca').val() === '1'; }"
            ],
            [
                'otro_especificar',
                'required',
                'when' => function ($model) {
                    $otroId = TiposBecas::getOtroId();
                    return $otroId !== null && (int)$model->tiene_beca === 1 && (int)$model->tipos_becas_id === (int)$otroId;
                },
                'whenClient' => "function(){
                    if (typeof window.TIPO_BECA_OTRO_ID === 'undefined' || window.TIPO_BECA_OTRO_ID === null) { return false; }
                    return $('#alumbecas-tiene_beca').val() === '1' && $('#alumbecas-tipos_becas_id').val() === String(window.TIPO_BECA_OTRO_ID);
                }"
            ],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['tipos_becas_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposBecas::class, 'targetAttribute' => ['tipos_becas_id' => 'id']],
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
            'tiene_beca' => 'Tiene Beca',
            'tipos_becas_id' => 'Tipos Becas ID',
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
     * Gets query for [[TiposBecas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiposBecas()
    {
        return $this->hasOne(TiposBecas::class, ['id' => 'tipos_becas_id']);
    }
}
