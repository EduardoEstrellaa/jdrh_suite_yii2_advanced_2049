<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumVivienda $model */

$this->title = Yii::t('app', 'Create Alum Vivienda');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Viviendas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-vivienda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
