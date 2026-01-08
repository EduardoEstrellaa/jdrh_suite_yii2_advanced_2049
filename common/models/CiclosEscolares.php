<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ciclos_escolares".
 *
 * @property int $id
 * @property string $nombre
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $periodo_texto
 * @property int $estados_ciclos_escolares_id
 *
 * @property CiclosSemestres[] $ciclosSemestres
 * @property EstadosCiclosEscolares $estadosCiclosEscolares
 */
class CiclosEscolares extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ciclos_escolares';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha_inicio', 'fecha_fin', 'periodo_texto', 'estados_ciclos_escolares_id'], 'required'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['estados_ciclos_escolares_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['periodo_texto'], 'string', 'max' => 250],
            [['estados_ciclos_escolares_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadosCiclosEscolares::class, 'targetAttribute' => ['estados_ciclos_escolares_id' => 'id']],
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
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'periodo_texto' => 'Periodo Texto',
            'estados_ciclos_escolares_id' => 'Estados Ciclos Escolares ID',
        ];
    }

    /**
     * Gets query for [[CiclosSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosSemestres()
    {
        return $this->hasMany(CiclosSemestres::class, ['ciclos_escolares_id' => 'id']);
    }

    /**
     * Gets query for [[EstadosCiclosEscolares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadosCiclosEscolares()
    {
        return $this->hasOne(EstadosCiclosEscolares::class, ['id' => 'estados_ciclos_escolares_id']);
    }
}
