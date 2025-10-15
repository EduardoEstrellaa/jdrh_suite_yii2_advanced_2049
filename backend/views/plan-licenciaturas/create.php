<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PlanLicenciaturas $model */

$this->title = Yii::t('app', 'Create Plan Licenciaturas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plan Licenciaturas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-licenciaturas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
