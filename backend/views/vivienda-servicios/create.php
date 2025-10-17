<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ViviendaServicios $model */

$this->title = Yii::t('app', 'Create Vivienda Servicios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vivienda Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vivienda-servicios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
