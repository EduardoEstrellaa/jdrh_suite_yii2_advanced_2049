<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Alergias $model */

$this->title = Yii::t('app', 'Create Alergias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alergias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alergias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
