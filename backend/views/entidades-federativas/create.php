<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\EntidadesFederativas $model */

$this->title = Yii::t('app', 'Create Entidades Federativas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entidades Federativas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entidades-federativas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
