<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoReaccionesAlergicas $model */

$this->title = Yii::t('app', 'Create Catalogo Reacciones Alergicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Reacciones Alergicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-reacciones-alergicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
