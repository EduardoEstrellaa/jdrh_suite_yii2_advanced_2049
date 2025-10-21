<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatalogoOrganizaciones $model */

$this->title = Yii::t('app', 'Create Catalogo Organizaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalogo Organizaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-organizaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
