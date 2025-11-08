<?php

use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var common\models\LugaresNacimiento $lugaresNacimiento */
/* @var common\models\DomiciliosActuales $domicilioActual */

$this->title = 'Actualizar Expediente';
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expediente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'perfil' => $perfil,
        'alumno' => $alumno,
        'datosPersonales' => $datosPersonales,
        'lugaresNacimiento' => $lugaresNacimiento,
        'domicilioActual' => $domicilioActual,
    ]) ?>

</div>