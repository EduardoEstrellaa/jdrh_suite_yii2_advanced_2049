<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AlumAsisteDentista $model */

$this->title = Yii::t('app', 'Create Alum Asiste Dentista');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Asiste Dentistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-asiste-dentista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
