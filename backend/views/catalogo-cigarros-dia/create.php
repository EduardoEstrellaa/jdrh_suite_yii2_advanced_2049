<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoCigarrosDia $model */

$this->title = Yii::t('app', 'Create Catalogo Cigarros Dia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Cigarros Dias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-cigarros-dia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
