<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoActividadEjercicio $model */

$this->title = Yii::t('app', 'Create Catalogo Actividad Ejercicio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Actividad Ejercicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-actividad-ejercicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
