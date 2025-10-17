<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumTransportes $model */

$this->title = Yii::t('app', 'Create Alum Transportes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Transportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-transportes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
