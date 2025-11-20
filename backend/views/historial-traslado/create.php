<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\HistorialTraslado $model */

$this->title = 'Create Historial Traslado';
$this->params['breadcrumbs'][] = ['label' => 'Historial Traslados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historial-traslado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
