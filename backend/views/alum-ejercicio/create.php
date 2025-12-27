<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AlumEjercicio $model */

$this->title = Yii::t('app', 'Create Alum Ejercicio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Ejercicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-ejercicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
