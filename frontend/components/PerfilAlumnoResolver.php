<?php

namespace frontend\components;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use common\models\Alumnos;

/**
 * Resultado de resolver perfil y alumno; permite short-circuit con redirect.
 */
class PerfilAlumnoResult
{
    /** @var \common\models\Perfil|null */
    public $perfil;

    /** @var Alumnos|null */
    public $alumno;

    /** @var Response|null */
    public $redirect;

    public function __construct($perfil = null, $alumno = null, $redirect = null)
    {
        $this->perfil = $perfil;
        $this->alumno = $alumno;
        $this->redirect = $redirect;
    }

    public static function redirect(Response $response)
    {
        return new self(null, null, $response);
    }
}

/**
 * Encapsula la obtenciÇün de perfil/alumno y las redirecciones con flash.
 */
class PerfilAlumnoResolver
{
    /**
     * Resuelve perfil y alumno o retorna un PerfilAlumnoResult con redirect.
     */
    public function resolve(Controller $controller)
    {
        $perfil = Yii::$app->user->identity->perfil ?? null;
        if (!$perfil) {
            Yii::$app->session->setFlash('error', 'No se encontrÇü un perfil asociado a tu cuenta.');
            return PerfilAlumnoResult::redirect($controller->redirect(['/perfil/create']));
        }

        $alumno = $this->findAlumno($perfil->id);
        if (!$alumno) {
            Yii::$app->session->setFlash('error', 'No se encontrÇü informaciÇün de alumno asociada a tu perfil.');
            return PerfilAlumnoResult::redirect($controller->redirect(['/perfil/update', 'id' => $perfil->id]));
        }

        return new PerfilAlumnoResult($perfil, $alumno, null);
    }

    /**
     * Busca un alumno por perfil.
     */
    private function findAlumno($perfilId)
    {
        return Alumnos::find()
            ->where(['perfil_id' => $perfilId])
            ->with(['generaciones', 'planLicenciaturas.licenciaturas'])
            ->one();
    }
}
