<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Nacionalidades $model */

$this->title = Yii::t('app', 'Create Nacionalidades');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nacionalidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nacionalidades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
