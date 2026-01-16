<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AlumHabitosConsumo $model */

$this->title = Yii::t('app', 'Update Alum Habitos Consumo: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Habitos Consumos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="alum-habitos-consumo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
