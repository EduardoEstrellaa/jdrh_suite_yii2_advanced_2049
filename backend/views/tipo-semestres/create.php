<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoSemestres $model */

$this->title = Yii::t('app', 'Create Tipo Semestres');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Semestres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-semestres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
