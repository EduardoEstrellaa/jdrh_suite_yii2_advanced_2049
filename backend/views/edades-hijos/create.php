<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\EdadesHijos $model */

$this->title = Yii::t('app', 'Create Edades Hijos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Edades Hijos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edades-hijos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
