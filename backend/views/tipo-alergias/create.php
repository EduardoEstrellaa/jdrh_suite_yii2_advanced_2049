<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoAlergias $model */

$this->title = Yii::t('app', 'Create Tipo Alergias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Alergias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-alergias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
