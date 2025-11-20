<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoBaja $model */

$this->title = 'Update Tipo Baja: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Bajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-baja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
