<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\DomiciliosActuales $model */

$this->title = Yii::t('app', 'Update Domicilios Actuales: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domicilios Actuales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="domicilios-actuales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
