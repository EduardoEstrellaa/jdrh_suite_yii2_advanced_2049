<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumLugaresComer $model */

$this->title = Yii::t('app', 'Create Alum Lugares Comer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Lugares Comers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-lugares-comer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
