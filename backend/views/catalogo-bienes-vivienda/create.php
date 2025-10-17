<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoBienesVivienda $model */

$this->title = Yii::t('app', 'Create Catalogo Bienes Vivienda');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Bienes Viviendas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-bienes-vivienda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
