<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\DatosPersonales $datosPersonales */
/** @var common\models\LugaresNacimiento $lugaresNacimiento */
/** @var common\models\DomiciliosActuales $domiciliosActuales */

$this->title = 'Expediente del Estudiante';
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expediente-view container mt-4">

    <h2 class="mb-4 text-center text-primary">
        <i class="fas fa-folder-open"></i> <?= Html::encode($this->title) ?>
    </h2>

    <div class="mb-4 text-center">
        <?= Html::a('Actualizar', ['update', 'perfil_id' => $perfil->id], ['class' => 'btn btn-primary me-2']) ?>
        <?= Html::a('<i class="fas fa-trash-alt"></i> Eliminar', [
            'delete',
            'perfil_id' => $perfil->id
        ], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que deseas eliminar este expediente?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('<i class="fas fa-arrow-left"></i> Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <hr>

    <!-- ===================== -->
    <!-- DATOS PERSONALES -->
    <!-- ===================== -->
    <h4><i class="fas fa-user text-primary"></i> Datos Personales</h4>

    <?= DetailView::widget([
        'model' => $datosPersonales,
        'attributes' => [
            [
                'attribute' => 'curp',
                'label' => 'CURP',
            ],
            [
                'attribute' => 'nss',
                'label' => 'NSS',
            ],
            [
                'attribute' => 'rfc',
                'label' => 'RFC',
            ],
        ],
        'options' => ['class' => 'table table-bordered table-striped'],
    ]) ?>

    <hr>

    <!-- ===================== -->
    <!-- LUGAR DE NACIMIENTO -->
    <!-- ===================== -->
    <h4><i class="fas fa-birthday-cake text-warning"></i> Lugar de Nacimiento</h4>

    <?= DetailView::widget([
        'model' => $lugaresNacimiento,
        'attributes' => [
            [
                'attribute' => 'entidades_federativas_id',
                'label' => 'Entidad Federativa',
                'value' => $lugaresNacimiento->entidadesFederativas->nombre ?? 'No especificado',
            ],
            [
                'attribute' => 'municipios_id',
                'label' => 'Municipio',
                'value' => $lugaresNacimiento->municipios->nombre ?? 'No especificado',
            ],
            [
                'attribute' => 'localidad',
                'label' => 'Localidad',
            ],
        ],
        'options' => ['class' => 'table table-bordered table-striped'],
    ]) ?>

    <hr>

    <!-- ===================== -->
    <!-- DOMICILIO ACTUAL -->
    <!-- ===================== -->
    <h4><i class="fas fa-home text-success"></i> Domicilio Actual</h4>

    <?= DetailView::widget([
        'model' => $domiciliosActuales,
        'attributes' => [
            [
                'attribute' => 'entidades_federativas_id',
                'label' => 'Entidad Federativa',
                'value' => $domiciliosActuales->entidadesFederativas->nombre ?? 'No especificado',
            ],
            [
                'attribute' => 'municipios_id',
                'label' => 'Municipio',
                'value' => $domiciliosActuales->municipios->nombre ?? 'No especificado',
            ],
            [
                'attribute' => 'localidad',
                'label' => 'Localidad',
            ],
            [
                'attribute' => 'calle',
                'label' => 'Calle',
            ],
            [
                'attribute' => 'numero_exterior',
                'label' => 'Número exterior',
            ],
            [
                'attribute' => 'numero_interior',
                'label' => 'Número interior',
            ],
            [
                'attribute' => 'colonia',
                'label' => 'Colonia',
            ],
            [
                'attribute' => 'codigo_postal',
                'label' => 'Código Postal',
            ],
        ],
        'options' => ['class' => 'table table-bordered table-striped'],
    ]) ?>

</div>