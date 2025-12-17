<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TiposTratamientos $model */

$this->title = Yii::t('app', 'Create Tipos Tratamientos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos Tratamientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-tratamientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
