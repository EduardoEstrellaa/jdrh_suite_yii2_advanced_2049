<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EstadosCiclosEscolares $model */

$this->title = Yii::t('app', 'Create Estados Ciclos Escolares');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estados Ciclos Escolares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-ciclos-escolares-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
