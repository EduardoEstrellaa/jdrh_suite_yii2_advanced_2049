<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumAlergia $model */

$this->title = Yii::t('app', 'Create Alum Alergia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Alergias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-alergia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
