<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\models\User;
use common\helpers\InputHelper;
use backend\models\Estado;
use yii\db\Query;

/** @var yii\web\View $this */
/** @var backend\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gestion de Usuarios';
$this->params['breadcrumbs'][] = $this->title;


$estadoOpciones = User::getEstadoLista();
$rolOpciones = User::getRolLista();
$tipoUsuarioOpciones = User::getTipoUsuarioLista();

$rawTotals = (new Query())
    ->select([
        'estado_nombre' => 'estado.estado_nombre',
        'total' => 'COUNT(*)'
    ])
    ->from(['user' => User::tableName()])
    ->innerJoin(['estado' => Estado::tableName()], 'estado.id = user.estado_id')
    ->groupBy('estado.estado_nombre')
    ->all();
$statusTotals = array_map('intval', array_column($rawTotals, 'total', 'estado_nombre'));
$summaryStatuses = ['Activo', 'Pendiente', 'Inactivo'];
$totalUsuarios = array_sum($statusTotals) ?: $dataProvider->getTotalCount();
$formModel = new \yii\base\DynamicModel(['status_id' => null]);
$formModel->addRule('status_id', 'integer');

?>
<div class="user-index">

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-start gap-3 mb-3">
                        <div>
                            <h1 class="h4 mb-1"><?= Html::encode($this->title) ?></h1>
                            <p class="text-muted mb-0">
                                Revisa y administra los alumnos registrados; usa los filtros para afinar rol, tipo y estado.
                            </p>
                        </div>
                        <span class="badge bg-secondary fw-semibold mt-1"><?= number_format($totalUsuarios) ?> registros</span>
                    </div>
                    <div class="row g-3">
                        <?php foreach ($summaryStatuses as $estado): ?>
                            <?php
                            $count = $statusTotals[$estado] ?? 0;
                            $color = match ($estado) {
                                'Activo' => 'success',
                                'Pendiente' => 'warning',
                                default => 'danger',
                            };
                            ?>
                            <div class="col-sm-4">
                                <div class="border rounded-3 p-3 bg-body-tertiary h-100">
                                    <p class="text-uppercase text-muted mb-2 small"><?= Html::encode($estado) ?></p>
                                    <h3 class="mb-1"><?= number_format($count) ?></h3>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-<?= $color ?>">&nbsp;</span>
                                        <span class="text-muted small">usuarios</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column h-100">
                    <h2 class="h6 mb-3">Habilitacion masiva</h2>
                    <p class="text-muted small mb-4">
                        Cambia el estado de varios alumnos de forma segura. Esta accion solo se ejecuta al presionar "Actualizar estado".
                    </p>
                    <?php $form = ActiveForm::begin([
                        'id' => 'bulk-status-form',
                        'action' => ['bulk-status'],
                        'method' => 'post',
                        'options' => ['class' => 'row g-3'],
                        'fieldConfig' => ['template' => '{label}{input}{error}']
                    ]); ?>
                    <div class="col-12">
                        <?= InputHelper::iconSelect2Field(
                            $form,
                            $formModel,
                            'status_id',
                            'fa-toggle-on',
                            $estadoOpciones,
                            [
                                'options' => [
                                    'class' => 'form-select',
                                    'placeholder' => 'Selecciona un estado',
                                ],
                            ],
                            [
                                'allowClear' => true,
                            ]
                        ) ?>
                    </div>
                    <div class="col-12 d-flex flex-wrap gap-2">
                        <?= Html::submitButton('Actualizar estado', [
                            'class' => 'btn btn-success flex-grow-1',
                            'data-confirm' => 'Seguro deseas actualizar el estado de los usuarios seleccionados?'
                        ]) ?>
                        <?= Html::button('Limpiar seleccion', [
                            'class' => 'btn btn-outline-secondary flex-grow-1',
                            'type' => 'button',
                            'onclick' => "document.querySelectorAll('#bulk-status-form input[name=\"selection[]\"]:checked').forEach(el=>el.checked=false);"
                        ]) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php $filterForm = ActiveForm::begin([
        'method' => 'get',
        'action' => ['user/index'],
        'options' => ['class' => 'card border-0 shadow-sm mb-4'],
        'fieldConfig' => ['template' => '{input}{error}'],
    ]); ?>
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold" for="usersearch-username">Usuario</label>
                <?= Html::activeTextInput($searchModel, 'username', [
                    'class' => 'form-control',
                    'id' => 'usersearch-username',
                    'placeholder' => 'Buscar usuario',
                ]) ?>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" for="usersearch-email">Email</label>
                <?= Html::activeTextInput($searchModel, 'email', [
                    'class' => 'form-control',
                    'id' => 'usersearch-email',
                    'placeholder' => 'Buscar email',
                ]) ?>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" for="usersearch-rol_id">Rol</label>
                <?= InputHelper::select2Filter(
                    $searchModel,
                    'rol_id',
                    $rolOpciones,
                    [
                        'placeholder' => 'Todos los roles',
                        'options' => ['id' => 'usersearch-rol_id'],
                    ],
                    ['allowClear' => true]
                ) ?>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" for="usersearch-tipo_usuario_id">Tipo de usuario</label>
                <?= InputHelper::select2Filter(
                    $searchModel,
                    'tipo_usuario_id',
                    $tipoUsuarioOpciones,
                    [
                        'placeholder' => 'Todos los tipos',
                        'options' => ['id' => 'usersearch-tipo_usuario_id'],
                    ],
                    ['allowClear' => true]
                ) ?>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" for="usersearch-estado_id">Estado</label>
                <?= InputHelper::select2Filter(
                    $searchModel,
                    'estado_id',
                    $estadoOpciones,
                    [
                        'placeholder' => 'Todos los estados',
                        'options' => ['id' => 'usersearch-estado_id'],
                    ],
                    ['allowClear' => true]
                ) ?>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <?= Html::submitButton('Aplicar filtros', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Limpiar filtros', ['user/index'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <div class="table-responsive shadow-sm rounded">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-hover table-striped align-middle mb-0'],
            'columns' => [
                [
                    'class' => 'yii\\grid\\CheckboxColumn',
                    'name' => 'selection[]',
                    'checkboxOptions' => function () {
                        return ['form' => 'bulk-status-form'];
                    },
                ],
                ['class' => 'yii\\grid\\SerialColumn'],
                ['attribute' => 'userLink', 'format' => 'raw'],
                ['attribute' => 'perfilLink', 'format' => 'raw'],
                'email:email',
                [
                    'attribute' => 'rolNombre',
                ],
                [
                    'attribute' => 'tipoUsuarioNombre',
                ],
                [
                    'attribute' => 'estadoNombre',
                    'format' => 'raw',
                    'value' => function (User $model) {
                        $estado = $model->estadoNombre;
                        $colores = [
                            'Activo' => 'success',
                            'Inactivo' => 'danger',
                            'Pendiente' => 'warning',
                        ];
                        $badgeClass = $colores[$estado] ?? 'secondary';
                        return Html::tag('span', Html::encode($estado), ['class' => "badge bg-{$badgeClass} rounded-pill"]);
                    },
                ],
                [
                    'class' => 'yii\\grid\\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'contentOptions' => ['class' => 'text-end'],
                ],
            ],
        ]) ?>
    </div>

</div>