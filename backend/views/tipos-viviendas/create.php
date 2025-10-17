<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TiposViviendas $model */

$this->title = Yii::t('app', 'Create Tipos Viviendas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos Viviendas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-viviendas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
