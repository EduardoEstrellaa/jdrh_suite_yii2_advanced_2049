<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LugaresNacimiento $model */

$this->title = Yii::t('app', 'Create Lugares Nacimiento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lugares Nacimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lugares-nacimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
