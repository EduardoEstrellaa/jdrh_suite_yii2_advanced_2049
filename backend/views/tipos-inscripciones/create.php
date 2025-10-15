<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TiposInscripciones $model */

$this->title = Yii::t('app', 'Create Tipos Inscripciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos Inscripciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-inscripciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
