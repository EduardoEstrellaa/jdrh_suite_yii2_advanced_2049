<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TipoOrganizacion $model */

$this->title = Yii::t('app', 'Create Tipo Organizacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Organizacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-organizacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
