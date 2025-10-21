<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoAlimentos $model */

$this->title = Yii::t('app', 'Create Catalogo Alimentos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Alimentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-alimentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
