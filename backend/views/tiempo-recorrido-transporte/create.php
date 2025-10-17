<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TiempoRecorridoTransporte $model */

$this->title = Yii::t('app', 'Create Tiempo Recorrido Transporte');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tiempo Recorrido Transportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiempo-recorrido-transporte-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
