<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AlumDeportes $model */

$this->title = Yii::t('app', 'Create Alum Deportes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Deportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-deportes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
