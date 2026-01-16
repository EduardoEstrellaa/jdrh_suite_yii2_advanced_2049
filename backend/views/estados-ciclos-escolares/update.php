<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EstadosCiclosEscolares $model */

$this->title = Yii::t('app', 'Update Estados Ciclos Escolares: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estados Ciclos Escolares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="estados-ciclos-escolares-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
