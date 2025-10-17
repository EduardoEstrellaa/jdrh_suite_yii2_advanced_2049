<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoTransportes $model */

$this->title = Yii::t('app', 'Create Catalogo Transportes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Transportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-transportes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
