<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\DatosPersonales $model */

$this->title = Yii::t('app', 'Create Datos Personales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos Personales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datos-personales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
