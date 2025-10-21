<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoUsoAnteojos $model */

$this->title = Yii::t('app', 'Create Catalogo Uso Anteojos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Uso Anteojos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-uso-anteojos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
