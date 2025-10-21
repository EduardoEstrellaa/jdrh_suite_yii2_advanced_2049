<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FrecuenciaVecesSemana $model */

$this->title = Yii::t('app', 'Create Frecuencia Veces Semana');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frecuencia Veces Semanas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frecuencia-veces-semana-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
