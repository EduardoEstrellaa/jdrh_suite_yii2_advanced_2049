<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoEquipo $model */

$this->title = 'Create Tipo Equipo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-equipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
