<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AsignacionesAlumnosGrupos $model */

$this->title = Yii::t('app', 'Create Asignaciones Alumnos Grupos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asignaciones Alumnos Grupos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignaciones-alumnos-grupos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
