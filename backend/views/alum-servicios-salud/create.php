<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AlumServiciosSalud $model */

$this->title = Yii::t('app', 'Create Alum Servicios Salud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Servicios Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-servicios-salud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
