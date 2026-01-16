<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Organizaciones $model */

$this->title = Yii::t('app', 'Create Organizaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
