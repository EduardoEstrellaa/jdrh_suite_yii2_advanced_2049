<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UnidadesEstudio $model */

$this->title = Yii::t('app', 'Create Unidades Estudio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unidades Estudios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidades-estudio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
