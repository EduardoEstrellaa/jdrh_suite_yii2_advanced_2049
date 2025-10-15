<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumDatosFamiliares $model */

$this->title = Yii::t('app', 'Create Alum Datos Familiares');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Datos Familiares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-datos-familiares-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
