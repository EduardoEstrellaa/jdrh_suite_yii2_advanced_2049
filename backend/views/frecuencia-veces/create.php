<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\FrecuenciaVeces $model */

$this->title = Yii::t('app', 'Create Frecuencia Veces');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frecuencia Veces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frecuencia-veces-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
