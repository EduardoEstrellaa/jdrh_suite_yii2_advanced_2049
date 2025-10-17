<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CategoriasDependencias $model */

$this->title = Yii::t('app', 'Create Categorias Dependencias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias Dependencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-dependencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
