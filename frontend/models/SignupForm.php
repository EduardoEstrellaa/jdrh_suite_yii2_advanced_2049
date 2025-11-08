<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use frontend\services\SignupService;

/**
 * Signup form
 */
class SignupForm extends Model
{
    //user
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    //perfil
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $genero_id;

    //alumnos
    public $matricula;
    public $plan_licenciaturas_id;
    public $generaciones_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // User
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nombre de usuario ya está en uso.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo electrónico ya está registrado.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            //Regla para confirmar la contraseña:
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseñas no coinciden.'],


            // Perfil
            [['nombre', 'apellido', 'fecha_nacimiento', 'genero_id'], 'required'],
            ['nombre', 'string', 'max' => 255],
            ['apellido', 'string', 'max' => 255],
            ['fecha_nacimiento', 'date', 'format' => 'php:Y-m-d'],
            ['genero_id', 'integer'],

            // Alumno
            [['matricula', 'plan_licenciaturas_id', 'generaciones_id'], 'required'],
            ['matricula', 'string', 'max' => 10],
            ['matricula', 'unique', 'targetClass' => '\common\models\Alumnos', 'message' => 'Esta matrícula ya está registrada.'],
            [['plan_licenciaturas_id', 'generaciones_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Nombre de Usuario',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
            'password_repeat' => 'Confirmar Contraseña',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'genero_id' => 'Género',
            'matricula' => 'Matrícula',
            'plan_licenciaturas_id' => 'Plan de Licenciatura',
            'generaciones_id' => 'Generación',
        ];
    }

    /**
     * Signs user up.
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $service = new SignupService();
        return $service->register($this->attributes);
    }
}
