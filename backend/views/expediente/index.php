<?php

use common\models\Alumnos;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var yii\web\View $this */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gestión de Expedientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expediente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> Aquí puedes gestionar todos los expedientes de los alumnos.
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'header' => 'ID Alumno',
                'contentOptions' => ['class' => 'text-center']
            ],

            [
                'attribute' => 'matricula',
                'header' => 'Matrícula',
                'contentOptions' => ['class' => 'text-center']
            ],

            [
                'label' => 'Nombre Completo',
                'value' => function ($model) {
                    return $model->perfil->getNombreCompleto();
                }
            ],

            [
                'label' => 'Estado Nacimiento',
                'value' => function ($model) {
                    return $model->perfil->lugaresNacimientos->entidadesFederativas->nombre ?? 'No especificado';
                }
            ],

            [
                'label' => 'Expediente',
                'value' => function ($model) {
                    $completado = $model->perfil->datosPersonales &&
                        $model->perfil->lugaresNacimientos &&
                        $model->perfil->domiciliosActuales;

                    return $completado ?
                        '<span class="badge bg-success">Completo</span>' :
                        '<span class="badge bg-warning">Incompleto</span>';
                },
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
    ]); ?>

    <?php Pjax::end(); ?>

</div>