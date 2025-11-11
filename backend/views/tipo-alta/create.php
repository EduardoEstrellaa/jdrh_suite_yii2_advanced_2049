<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoAlta $model */

$this->title = 'Create Tipo Alta';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Altas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-alta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
