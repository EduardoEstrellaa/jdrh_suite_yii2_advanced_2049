<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ViviendaBienes $model */

$this->title = Yii::t('app', 'Create Vivienda Bienes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vivienda Bienes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vivienda-bienes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
