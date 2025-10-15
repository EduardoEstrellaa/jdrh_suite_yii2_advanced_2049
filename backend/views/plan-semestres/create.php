<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PlanSemestres $model */

$this->title = Yii::t('app', 'Create Plan Semestres');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plan Semestres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-semestres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
