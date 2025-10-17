<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoDependenciasEconomicas $model */

$this->title = Yii::t('app', 'Update Catalogo Dependencias Economicas: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Dependencias Economicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="catalogo-dependencias-economicas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
