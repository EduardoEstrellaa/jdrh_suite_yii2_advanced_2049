<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Modelos $model */

$this->title = 'Create Modelos';
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
