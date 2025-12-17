<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoTratamientos $model */

$this->title = Yii::t('app', 'Create Catalogo Tratamientos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Tratamientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-tratamientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
