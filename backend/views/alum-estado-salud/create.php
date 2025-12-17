<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AlumEstadoSalud $model */

$this->title = Yii::t('app', 'Create Alum Estado Salud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Estado Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-estado-salud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
