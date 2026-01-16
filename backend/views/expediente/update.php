<?php

use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var array $formParams */

$this->title = 'Actualizar Expediente';
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expediente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderFile('@frontend/views/expediente/_form.php', $formParams) ?>

</div>
