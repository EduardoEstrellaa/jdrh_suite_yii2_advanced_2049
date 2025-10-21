<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumRecreacionTiempo $model */

$this->title = Yii::t('app', 'Create Alum Recreacion Tiempo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Recreacion Tiempos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-recreacion-tiempo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
