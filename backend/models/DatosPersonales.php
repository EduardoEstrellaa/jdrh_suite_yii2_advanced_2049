<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "datos_personales".
 *
 * @property int $id
 * @property int $perfil_id
 * @property string $curp
 * @property string|null $nss
 * @property string|null $rfc
 *
 * @property Perfil $perfil
 */
class DatosPersonales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datos_personales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perfil_id', 'curp'], 'required'],
            [['perfil_id'], 'integer'],
            [['curp'], 'string', 'max' => 18],
            [['nss'], 'string', 'max' => 11],
            [['rfc'], 'string', 'max' => 13],
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
            'curp' => 'Curp',
            'nss' => 'Nss',
            'rfc' => 'Rfc',
        ];
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
