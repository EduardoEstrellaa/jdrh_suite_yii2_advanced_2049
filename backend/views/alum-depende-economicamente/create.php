<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumDependeEconomicamente $model */

$this->title = Yii::t('app', 'Create Alum Depende Economicamente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Depende Economicamentes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-depende-economicamente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
