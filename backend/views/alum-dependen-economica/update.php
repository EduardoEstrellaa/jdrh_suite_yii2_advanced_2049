<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumDependenEconomica $model */

$this->title = Yii::t('app', 'Update Alum Dependen Economica: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Dependen Economicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="alum-dependen-economica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
