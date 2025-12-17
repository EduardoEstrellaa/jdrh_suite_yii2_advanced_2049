<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoProblemasSalud $model */

$this->title = Yii::t('app', 'Update Catalogo Problemas Salud: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Problemas Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="catalogo-problemas-salud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
