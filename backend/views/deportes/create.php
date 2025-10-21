<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Deportes $model */

$this->title = Yii::t('app', 'Create Deportes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deportes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
