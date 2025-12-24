<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoReaccionesAlergicas $model */

$this->title = Yii::t('app', 'Update Catalogo Reacciones Alergicas: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Reacciones Alergicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="catalogo-reacciones-alergicas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
