<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoAlta $model */

$this->title = 'Update Tipo Alta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Altas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-alta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
