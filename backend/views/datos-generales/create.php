<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\DatosGenerales $model */

$this->title = Yii::t('app', 'Create Datos Generales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos Generales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datos-generales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
