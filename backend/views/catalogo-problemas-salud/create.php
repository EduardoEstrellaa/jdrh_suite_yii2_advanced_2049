<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoProblemasSalud $model */

$this->title = Yii::t('app', 'Create Catalogo Problemas Salud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Problemas Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-problemas-salud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
