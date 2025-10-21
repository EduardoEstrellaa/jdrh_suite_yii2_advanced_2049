<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumConsumoAlimentos $model */

$this->title = Yii::t('app', 'Create Alum Consumo Alimentos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Consumo Alimentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-consumo-alimentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
