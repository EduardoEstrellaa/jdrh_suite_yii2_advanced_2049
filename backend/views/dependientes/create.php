<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Dependientes $model */

$this->title = Yii::t('app', 'Create Dependientes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dependientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependientes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
