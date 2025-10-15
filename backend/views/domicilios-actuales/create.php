<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\DomiciliosActuales $model */

$this->title = Yii::t('app', 'Create Domicilios Actuales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domicilios Actuales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domicilios-actuales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
