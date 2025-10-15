<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Licenciaturas $model */

$this->title = Yii::t('app', 'Create Licenciaturas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Licenciaturas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licenciaturas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
