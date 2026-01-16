<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CategoriasCatalogoAlimentos $model */

$this->title = Yii::t('app', 'Create Categorias Catalogo Alimentos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias Catalogo Alimentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-catalogo-alimentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
