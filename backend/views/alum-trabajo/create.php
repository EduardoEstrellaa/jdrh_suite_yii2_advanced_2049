<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumTrabajo $model */

$this->title = Yii::t('app', 'Create Alum Trabajo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Trabajos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-trabajo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
