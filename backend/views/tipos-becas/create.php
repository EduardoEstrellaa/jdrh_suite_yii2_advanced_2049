<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TiposBecas $model */

$this->title = Yii::t('app', 'Create Tipos Becas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos Becas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-becas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
