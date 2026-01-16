<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EjercicioFisico $model */

$this->title = Yii::t('app', 'Create Ejercicio Fisico');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ejercicio Fisicos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ejercicio-fisico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
