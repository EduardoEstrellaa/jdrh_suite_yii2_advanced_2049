<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumEnfermedadesCronicas $model */

$this->title = Yii::t('app', 'Create Alum Enfermedades Cronicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Enfermedades Cronicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-enfermedades-cronicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
