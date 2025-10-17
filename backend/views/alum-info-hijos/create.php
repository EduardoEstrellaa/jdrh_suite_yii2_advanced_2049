<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumInfoHijos $model */

$this->title = Yii::t('app', 'Create Alum Info Hijos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Info Hijos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-info-hijos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
