<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoAlergias $model */

$this->title = Yii::t('app', 'Create Catalogo Alergias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Alergias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-alergias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
