<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoUsosInternet $model */

$this->title = Yii::t('app', 'Create Catalogo Usos Internet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Usos Internets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-usos-internet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
