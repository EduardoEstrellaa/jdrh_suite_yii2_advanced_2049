<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoDeportes $model */

$this->title = Yii::t('app', 'Create Catalogo Deportes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Deportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-deportes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
