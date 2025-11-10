<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EstadoEquipo $model */

$this->title = 'Create Estado Equipo';
$this->params['breadcrumbs'][] = ['label' => 'Estado Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-equipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
