<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AlumAsisteMedico $model */

$this->title = Yii::t('app', 'Create Alum Asiste Medico');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alum Asiste Medicos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-asiste-medico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
