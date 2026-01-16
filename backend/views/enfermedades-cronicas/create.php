<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EnfermedadesCronicas $model */

$this->title = Yii::t('app', 'Create Enfermedades Cronicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Enfermedades Cronicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enfermedades-cronicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
