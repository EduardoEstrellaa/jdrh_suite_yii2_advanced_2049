<?php

use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var common\models\LugaresNacimiento $lugaresNacimiento */
/* @var common\models\DomiciliosActuales $domiciliosActuales */

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
        'domiciliosActuales' => $domiciliosActuales,
        'datosGenerales' => $datosGenerales,
        'alumDatosFamiliares' => $alumDatosFamiliares,
        'alumBecas' => $alumBecas,
        'alumInfoHijos' => $alumInfoHijos,
        'alumDependeEconomicamente' => $alumDependeEconomicamente,
        'alumDependenEconomica' => $alumDependenEconomica,
        'dependientes' => $dependientes ?? [],
        'dependientesSeleccionados' => $dependientesSeleccionados ?? [],
        'dependientesOtro' => $dependientesOtro ?? null,
        'edadesHijos' => $edadesHijos,
        'alumTrabajo' => $alumTrabajo,
    ]) ?>

</div>
