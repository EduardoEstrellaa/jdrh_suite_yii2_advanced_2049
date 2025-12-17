<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoBienesPersonales $model */

$this->title = Yii::t('app', 'Create Catalogo Bienes Personales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Bienes Personales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-bienes-personales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
