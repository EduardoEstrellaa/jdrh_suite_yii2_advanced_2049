<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoServiciosVivienda $model */

$this->title = Yii::t('app', 'Create Catalogo Servicios Vivienda');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Servicios Viviendas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-servicios-vivienda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
