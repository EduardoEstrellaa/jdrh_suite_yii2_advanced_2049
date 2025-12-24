<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VariasReaccionesAlergicas $model */

$this->title = Yii::t('app', 'Create Varias Reacciones Alergicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Varias Reacciones Alergicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varias-reacciones-alergicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
