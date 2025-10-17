<?php

use yii\helpers\Html;
use common\models\PermisosHelpers;

use yii\helpers\Url;


/** @var yii\web\View $this */

$this->title = 'JDRH - SUITE';
$es_admin = PermisosHelpers::requerirMinimoRol('Admin');

?>

<div class="site-index">
    <div class="container">
        <center>
            <p class="bienvenida">Estamos encantados de que estés aquí. Nuestro sistema está diseñado para facilitar el control y gestión de dictámenes que aseguran un manejo efectivo y transparente de la información.
                Explora todas nuestras herramientas y funcionalidades, y descubre cómo podemos ayudarte a optimizar la gestión de tus dictámenes. Si tienes alguna pregunta o sugerencia, no dudes en ponerte en contacto con nosotros.
            </p>

            <h3>¡Disfruta de tu visita!</h3>
        </center>
    </div>
</div>
