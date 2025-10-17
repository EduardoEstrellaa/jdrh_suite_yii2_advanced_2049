<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumDependenEconomica $model */

$this->title = Yii::t('app', 'Create Alum Dependen Economica');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Dependen Economicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-dependen-economica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
