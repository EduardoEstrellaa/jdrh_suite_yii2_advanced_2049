<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoDependenciasEconomicas $model */

$this->title = Yii::t('app', 'Create Catalogo Dependencias Economicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Dependencias Economicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-dependencias-economicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
