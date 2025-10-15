<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CiclosEscolares $model */

$this->title = Yii::t('app', 'Create Ciclos Escolares');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ciclos Escolares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciclos-escolares-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
