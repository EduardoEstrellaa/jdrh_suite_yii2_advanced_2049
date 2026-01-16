<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CatalogoEnfermCronicas $model */

$this->title = Yii::t('app', 'Create Catalogo Enferm Cronicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Enferm Cronicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-enferm-cronicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
