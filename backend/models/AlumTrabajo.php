<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_trabajo".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $tiene_trabajo
 * @property string|null $nombre_empresa
 * @property string|null $puesto_ocupacion
 * @property string|null $horario_entrada
 * @property string|null $horario_salida
 *
 * @property Alumnos $alumnos
 */
class AlumTrabajo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_trabajo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'tiene_trabajo'], 'required'],
            [['alumnos_id', 'tiene_trabajo'], 'integer'],
            [['horario_entrada', 'horario_salida'], 'safe'],
            [['nombre_empresa', 'puesto_ocupacion'], 'string', 'max' => 150],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
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
            'tiene_trabajo' => 'Tiene Trabajo',
            'nombre_empresa' => 'Nombre Empresa',
            'puesto_ocupacion' => 'Puesto Ocupacion',
            'horario_entrada' => 'Horario Entrada',
            'horario_salida' => 'Horario Salida',
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
}
