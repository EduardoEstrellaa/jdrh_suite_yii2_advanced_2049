<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumOrganizacion $model */

$this->title = Yii::t('app', 'Create Alum Organizacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Organizacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-organizacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
