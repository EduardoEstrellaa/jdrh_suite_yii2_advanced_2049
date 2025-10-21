<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Tratamientos $model */

$this->title = Yii::t('app', 'Create Tratamientos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tratamientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tratamientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
