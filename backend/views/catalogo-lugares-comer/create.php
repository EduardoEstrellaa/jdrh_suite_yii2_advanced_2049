<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoLugaresComer $model */

$this->title = Yii::t('app', 'Create Catalogo Lugares Comer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Lugares Comers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-lugares-comer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
