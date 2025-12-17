<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoGravedad $model */

$this->title = Yii::t('app', 'Create Tipo Gravedad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Gravedads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-gravedad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
