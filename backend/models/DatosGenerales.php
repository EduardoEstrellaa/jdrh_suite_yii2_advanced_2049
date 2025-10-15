<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "datos_generales".
 *
 * @property int $id
 * @property int $perfil_id
 * @property string|null $tlf_personal
 * @property string|null $tlf_emergencia
 * @property string|null $email_personal
 * @property int|null $maya_hablante
 * @property int $estados_civiles_id
 * @property int $nacionalidades_id
 *
 * @property EstadosCiviles $estadosCiviles
 * @property Nacionalidades $nacionalidades
 * @property Perfil $perfil
 */
class DatosGenerales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datos_generales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perfil_id', 'estados_civiles_id', 'nacionalidades_id'], 'required'],
            [['perfil_id', 'maya_hablante', 'estados_civiles_id', 'nacionalidades_id'], 'integer'],
            [['tlf_personal', 'tlf_emergencia'], 'string', 'max' => 13],
            [['email_personal'], 'string', 'max' => 250],
            [['estados_civiles_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadosCiviles::class, 'targetAttribute' => ['estados_civiles_id' => 'id']],
            [['nacionalidades_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nacionalidades::class, 'targetAttribute' => ['nacionalidades_id' => 'id']],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::class, 'targetAttribute' => ['perfil_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perfil_id' => 'Perfil ID',
            'tlf_personal' => 'Tlf Personal',
            'tlf_emergencia' => 'Tlf Emergencia',
            'email_personal' => 'Email Personal',
            'maya_hablante' => 'Maya Hablante',
            'estados_civiles_id' => 'Estados Civiles ID',
            'nacionalidades_id' => 'Nacionalidades ID',
        ];
    }

    /**
     * Gets query for [[EstadosCiviles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadosCiviles()
    {
        return $this->hasOne(EstadosCiviles::class, ['id' => 'estados_civiles_id']);
    }

    /**
     * Gets query for [[Nacionalidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNacionalidades()
    {
        return $this->hasOne(Nacionalidades::class, ['id' => 'nacionalidades_id']);
    }

    /**
     * Gets query for [[Perfil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfil::class, ['id' => 'perfil_id']);
    }
}
