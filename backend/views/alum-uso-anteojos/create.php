<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumUsoAnteojos $model */

$this->title = Yii::t('app', 'Create Alum Uso Anteojos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Uso Anteojos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-uso-anteojos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
