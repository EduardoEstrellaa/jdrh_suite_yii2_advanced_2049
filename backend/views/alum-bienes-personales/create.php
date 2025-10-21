<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumBienesPersonales $model */

$this->title = Yii::t('app', 'Create Alum Bienes Personales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Bienes Personales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-bienes-personales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
