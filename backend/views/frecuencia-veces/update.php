<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FrecuenciaVeces $model */

$this->title = Yii::t('app', 'Update Frecuencia Veces: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frecuencia Veces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="frecuencia-veces-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
