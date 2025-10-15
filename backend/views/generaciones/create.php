<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Generaciones $model */

$this->title = Yii::t('app', 'Create Generaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Generaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="generaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
