<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BajaEquipo $model */

$this->title = 'Update Baja Equipo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Baja Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="baja-equipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
