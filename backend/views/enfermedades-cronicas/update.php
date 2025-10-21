<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\EnfermedadesCronicas $model */

$this->title = Yii::t('app', 'Update Enfermedades Cronicas: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Enfermedades Cronicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="enfermedades-cronicas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
