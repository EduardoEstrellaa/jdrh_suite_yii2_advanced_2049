<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ProblemasSalud $model */

$this->title = Yii::t('app', 'Create Problemas Salud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Problemas Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="problemas-salud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
