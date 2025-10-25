<?php

namespace frontend\services;

use Yii;
use common\models\User;
use frontend\models\Perfil;
use backend\models\Alumnos;
use yii\db\Exception;

class SignupService
{
    public function register(array $data): ?User
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            // 1️⃣ Crear usuario
            $user = new User();
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->setPassword($data['password']);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            if (!$user->save()) {
                throw new Exception('Error al guardar el usuario.');
            }

            // 2️⃣ Crear perfil
            $perfil = new Perfil();
            $perfil->user_id = $user->id;
            $perfil->nombre = $data['nombre'];
            $perfil->apellido = $data['apellido'];
            $perfil->fecha_nacimiento = $data['fecha_nacimiento'];
            $perfil->genero_id = $data['genero_id'];
            if (!$perfil->save()) {
                throw new Exception('Error al guardar el perfil.');
            }

            // 3️⃣ Crear alumno
            $alumno = new Alumnos();
            $alumno->perfil_id = $perfil->id;
            $alumno->matricula = $data['matricula'];
            $alumno->plan_licenciaturas_id = $data['plan_licenciaturas_id'];
            $alumno->generaciones_id = $data['generaciones_id'];
            if (!$alumno->save()) {
                throw new Exception('Error al guardar el alumno.');
            }

            $transaction->commit();

            // 4️⃣ Enviar email
            $this->sendEmail($user);

            return $user;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            return null;
        }
    }

    protected function sendEmail(User $user): bool
    {
        return Yii::$app->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
