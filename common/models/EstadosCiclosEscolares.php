<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estados_ciclos_escolares".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property CiclosEscolares[] $ciclosEscolares
 */
class EstadosCiclosEscolares extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estados_ciclos_escolares';
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
     * Gets query for [[CiclosEscolares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosEscolares()
    {
        return $this->hasMany(CiclosEscolares::class, ['estados_ciclos_escolares_id' => 'id']);
    }
}
