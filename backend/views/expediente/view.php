<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Perfil $perfil
 * @var common\models\Alumnos $alumno
 * @var array $viewParams
 */

$this->title = 'Consultar expediente';
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="expediente-view">
    <?= Yii::$app->view->renderFile('@frontend/views/expediente/view.php', $viewParams) ?>
</div>
