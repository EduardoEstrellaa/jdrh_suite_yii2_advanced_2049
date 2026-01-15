<?php

use backend\forms\reportes\BecasApoyosReportRequest;
use common\helpers\InputHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$filter = $filter ?? new BecasApoyosReportRequest();
$pdfUrl = Url::to(array_merge(['becas'], Yii::$app->request->queryParams, ['format' => 'pdf']));
$this->registerCssFile('@web/css/reportes-becas-apoyos.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
?>
<div class="reportes-becas">
    <div class="reportes-becas__hero card shadow-sm mb-4">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3 align-items-start">
            <div>
                <h4 class="mb-1">Becas y apoyos estudiantiles</h4>
                <p class="text-muted mb-0">Filtra por generacion, tipo de beca, ciclo o alumnos que actualmente tienen algun apoyo.</p>
            </div>
            <div class="reportes-becas__hero-cta">
                <a href="<?= Html::encode($pdfUrl) ?>" class="btn btn-outline-secondary btn-sm reportes-becas__btn">
                    <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                </a>
            </div>
        </div>
    </div>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to(['reportes/becas']),
        'options' => ['class' => 'card reportes-becas__filter-panel shadow-sm mb-4'],
    ]); ?>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-3 col-md-6">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'generacion_id',
                        'fa-layer-group',
                        $generaciones,
                        ['placeholder' => 'Generacion']
                    ) ?>
                </div>
                <div class="col-lg-3 col-md-6">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'tipo_beca_id',
                        'fa-award',
                        $tiposBecas,
                        ['placeholder' => 'Tipo de beca']
                    ) ?>
                </div>
                <div class="col-lg-3 col-md-6">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'ciclo_escolar_id',
                        'fa-calendar-alt',
                        $ciclos,
                        ['placeholder' => 'Ciclo escolar']
                    ) ?>
                </div>
                <div class="col-lg-3 col-md-6">
                    <?php $switchId = Html::getInputId($filter, 'solo_con_beca'); ?>
                    <div class="w-100">
                        <?= $form->field($filter, 'solo_con_beca', [
                            'options' => ['class' => 'form-field mb-0'],
                            'template' => '<div class="form-check form-switch reportes-becas__switch-content">{input}<label class="form-check-label ms-2" for="' . $switchId . '">Solo con beca</label></div>{error}',
                        ])->checkbox(['class' => 'form-check-input', 'id' => $switchId], false) ?>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-end mt-3 reportes-becas__filter-actions">
                <button type="submit" class="btn btn-primary reportes-becas__btn">Aplicar filtros</button>
                <a href="<?= Url::to(['becas']) ?>" class="btn btn-outline-secondary reportes-becas__btn">Limpiar filtros</a>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

    <div class="card reportes-becas__table-card shadow-sm mb-4">
        <div class="card-body p-0">
            <?php if ($datos): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0 reportes-becas__table">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Matricula</th>
                                <th>Generacion</th>
                                <th>Tipo de beca</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $fila): ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold"><?= Html::encode($fila['nombre']) ?></div>
                                    </td>
                                    <td><?= Html::encode($fila['matricula']) ?></td>
                                    <td><?= Html::encode($fila['generacion']) ?></td>
                                    <td>
                                        <span class="text-muted small d-block">Tipo</span>
                                        <strong><?= Html::encode($fila['tipo']) ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge <?= $fila['estatus'] === 'Vigente' ? 'bg-success' : 'bg-secondary' ?> reportes-becas__status">
                                            <?= Html::encode($fila['estatus']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-4">
                    <div class="alert alert-warning mb-0">No hay registros disponibles con los filtros seleccionados.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($totalesPorTipo): ?>
        <div class="card reportes-becas__totals-card shadow-sm">
            <div class="card-body">
                <h6 class="reportes-becas__totals-title mb-3">Totales por tipo de beca</h6>
                <div class="row g-3 reportes-becas__totals-grid">
                    <?php foreach ($totalesPorTipo as $tipo => $cantidad): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <article class="reportes-becas__total-card">
                                <p class="reportes-becas__total-label"><?= Html::encode($tipo) ?></p>
                                <p class="reportes-becas__total-value"><?= Html::encode($cantidad) ?></p>
                                <p class="text-muted small mb-0">Estudiantes beneficiados</p>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
