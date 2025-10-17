<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "edades_hijos".
 *
 * @property int $id
 * @property int $alum_info_hijos_id
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $fecha_nacimiento
 *
 * @property AlumInfoHijos $alumInfoHijos
 */
class EdadesHijos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edades_hijos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alum_info_hijos_id', 'nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento'], 'required'],
            [['alum_info_hijos_id'], 'integer'],
            [['fecha_nacimiento'], 'safe'],
            [['nombre', 'apellido_paterno', 'apellido_materno'], 'string', 'max' => 150],
            [['alum_info_hijos_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumInfoHijos::class, 'targetAttribute' => ['alum_info_hijos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alum_info_hijos_id' => 'Alum Info Hijos ID',
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'fecha_nacimiento' => 'Fecha Nacimiento',
        ];
    }

    /**
     * Gets query for [[AlumInfoHijos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInfoHijos()
    {
        return $this->hasOne(AlumInfoHijos::class, ['id' => 'alum_info_hijos_id']);
    }
}
