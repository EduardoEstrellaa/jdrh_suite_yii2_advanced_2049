<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alum_datos_familiares".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property string $padre_nombre
 * @property string $padre_apellido_paterno
 * @property string $padre_apellido_materno
 * @property string $padre_ocupacion
 * @property int $padre_mayahablante
 * @property string $madre_nombre
 * @property string $madre_apellido_paterno
 * @property string $madre_apellido_materno
 * @property string $madre_ocupacion
 * @property int $madre_mayahablante
 *
 * @property Alumnos $alumnos
 */
class AlumDatosFamiliares extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_datos_familiares';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'padre_nombre', 'padre_apellido_paterno', 'padre_apellido_materno', 'padre_ocupacion', 'padre_mayahablante', 'madre_nombre', 'madre_apellido_paterno', 'madre_apellido_materno', 'madre_ocupacion', 'madre_mayahablante'], 'required'],
            [['id', 'alumnos_id', 'padre_mayahablante', 'madre_mayahablante'], 'integer'],
            [['padre_nombre', 'padre_apellido_paterno', 'padre_apellido_materno', 'padre_ocupacion', 'madre_nombre', 'madre_apellido_paterno', 'madre_apellido_materno', 'madre_ocupacion'], 'string', 'max' => 150],
            [['id'], 'unique'],
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
            'padre_nombre' => 'Padre Nombre',
            'padre_apellido_paterno' => 'Padre Apellido Paterno',
            'padre_apellido_materno' => 'Padre Apellido Materno',
            'padre_ocupacion' => 'Padre Ocupacion',
            'padre_mayahablante' => 'Padre Mayahablante',
            'madre_nombre' => 'Madre Nombre',
            'madre_apellido_paterno' => 'Madre Apellido Paterno',
            'madre_apellido_materno' => 'Madre Apellido Materno',
            'madre_ocupacion' => 'Madre Ocupacion',
            'madre_mayahablante' => 'Madre Mayahablante',
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
