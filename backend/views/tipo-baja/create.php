<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoBaja $model */

$this->title = 'Create Tipo Baja';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Bajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-baja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
