<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumTratamientos $model */

$this->title = Yii::t('app', 'Create Alum Tratamientos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Tratamientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-tratamientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
