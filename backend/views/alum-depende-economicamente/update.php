<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumDependeEconomicamente $model */

$this->title = Yii::t('app', 'Update Alum Depende Economicamente: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Depende Economicamentes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="alum-depende-economicamente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
