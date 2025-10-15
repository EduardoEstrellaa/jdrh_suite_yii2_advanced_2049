<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumInscripciones $model */

$this->title = Yii::t('app', 'Create Alum Inscripciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Inscripciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-inscripciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
