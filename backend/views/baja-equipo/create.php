<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BajaEquipo $model */

$this->title = 'Create Baja Equipo';
$this->params['breadcrumbs'][] = ['label' => 'Baja Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baja-equipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
