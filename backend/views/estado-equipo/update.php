<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EstadoEquipo $model */

$this->title = 'Update Estado Equipo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estado Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estado-equipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
