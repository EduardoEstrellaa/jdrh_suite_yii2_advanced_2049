<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoLugaresAccesoPrincipal $model */

$this->title = Yii::t('app', 'Create Catalogo Lugares Acceso Principal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Lugares Acceso Principals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-lugares-acceso-principal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
