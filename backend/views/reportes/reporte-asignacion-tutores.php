<?php

use backend\forms\reportes\AsignacionTutoresReportRequest;
use common\helpers\InputHelper;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var AsignacionTutoresReportRequest $filter */

$botonPdf = Url::to(array_merge(['asignacion'], Yii::$app->request->queryParams, ['format' => 'pdf']));
$this->registerCssFile('@web/css/reportes-asignacion.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
?>
<div class="reportes-asignacion">
    <div class="reportes-asignacion__hero card shadow-sm mb-4">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3 align-items-start">
            <div>
                <h4 class="mb-1">Asignacion de tutores, grupos y alumnos</h4>
                <p class="text-muted mb-0">Visualiza la distribucion por ciclo y genera un resumen inmediato.</p>
            </div>
            <div class="reportes-asignacion__hero-cta mt-md-1">
                <a href="<?= Html::encode($botonPdf) ?>" class="btn btn-outline-secondary btn-sm">Exportar PDF</a>
            </div>
        </div>
    </div>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['asignacion'],
        'options' => ['class' => 'card reportes-asignacion__filter-card shadow-sm mb-4'],
    ]); ?>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-3">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'ciclo_escolar_id',
                        'fa-calendar-alt',
                        $ciclos,
                        ['placeholder' => 'Seleccione un ciclo'],
                        ['allowClear' => true]
                    ) ?>
                </div>
                <div class="col-lg-3">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'semestre_id',
                        'fa-graduation-cap',
                        $semestres,
                        ['placeholder' => 'Seleccione un semestre'],
                        ['allowClear' => true]
                    ) ?>
                </div>
                <div class="col-lg-3">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'grupo_id',
                        'fa-users',
                        $grupos,
                        ['placeholder' => 'Seleccione un grupo'],
                        ['allowClear' => true]
                    ) ?>
                </div>
                <div class="col-lg-3">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'tutor_id',
                        'fa-user-tie',
                        $tutores,
                        ['placeholder' => 'Seleccione un tutor'],
                        ['allowClear' => true]
                    ) ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <button type="submit" class="btn btn-primary px-4">Aplicar</button>
                        <a href="<?= Url::to(['asignacion']) ?>" class="btn btn-outline-secondary px-4">Limpiar</a>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

    <div class="row g-3 mb-4 reportes-asignacion__stats-row">
        <div class="col-md-4">
            <div class="card reportes-asignacion__stat-card reportes-asignacion__stat-card--tutores shadow-sm h-100">
                <div class="card-body">
                    <p class="reportes-asignacion__stat-label mb-1">Tutores visibles</p>
                    <h5 class="reportes-asignacion__stat-value mb-0"><?= Html::encode($totales['tutores']) ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card reportes-asignacion__stat-card reportes-asignacion__stat-card--grupos shadow-sm h-100">
                <div class="card-body">
                    <p class="reportes-asignacion__stat-label mb-1">Grupos listados</p>
                    <h5 class="reportes-asignacion__stat-value mb-0"><?= Html::encode($totales['grupos']) ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card reportes-asignacion__stat-card reportes-asignacion__stat-card--alumnos shadow-sm h-100">
                <div class="card-body">
                    <p class="reportes-asignacion__stat-label mb-1">Alumnos agrupados</p>
                    <h5 class="reportes-asignacion__stat-value mb-0"><?= Html::encode($totales['alumnos']) ?></h5>
                </div>
            </div>
        </div>
    </div>

    <?php if (!$tieneFiltroCiclo): ?>
        <div class="alert alert-info">Seleccione un ciclo escolar para activar el reporte.</div>
<?php endif; ?>

<?php
$script = <<<'JS'
(function () {
    const modalElement = document.getElementById('detalleModal');
    if (!modalElement) {
        return;
    }

    const modalTitle = modalElement.querySelector('#detalleModalLabel');
    const modalList = modalElement.querySelector('.reportes-asignacion__modal-list');

    modalElement.addEventListener('show.bs.modal', (event) => {
        const trigger = event.relatedTarget;
        if (!trigger) {
            return;
        }
        const studentsData = trigger.getAttribute('data-students');
        const tutorName = trigger.getAttribute('data-tutor') || 'Tutor';
        let students = [];
        try {
            students = studentsData ? JSON.parse(studentsData) : [];
        } catch {
            students = [];
        }
        modalTitle.textContent = `Alumnos de ${tutorName}`;
        modalList.innerHTML = students.length
            ? students.map((name) => `<li>• ${name}</li>`).join('')
            : '<li class="text-muted">Sin alumnos registrados.</li>';
    });
})();
JS;
$this->registerJs($script);
?>

</div>

<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Alumnos del tutor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled mb-0 reportes-asignacion__modal-list"></ul>
            </div>
        </div>
    </div>
</div>

    <?php if ($tieneFiltroCiclo && $tabla): ?>
        <div class="card reportes-asignacion__table-card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0 reportes-asignacion__table">
                        <thead>
                            <tr>
                                <th>Tutor</th>
                                <th>Grupo</th>
                                <th>Semestre</th>
                                <th>Alumnos</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tabla as $index => $fila): ?>
                                <tr>
                                    <td><?= Html::encode($fila['tutor']) ?></td>
                                    <td><?= Html::encode($fila['grupo']) ?></td>
                                    <td><?= Html::encode($fila['semestre']) ?></td>
                                    <td><?= Html::encode($fila['conteo']) ?></td>
                                    <td>
                                        <?php if ($fila['alumnos']): ?>
                                            <button class="btn btn-link btn-sm px-0 reportes-asignacion__detail-btn" type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detalleModal"
                                                data-students='<?= Html::encode(Json::encode($fila['alumnos'])) ?>'
                                                data-tutor="<?= Html::encode($fila['tutor']) ?>">
                                                Ver lista
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted small">Sin alumnos</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php elseif ($tieneFiltroCiclo): ?>
        <div class="alert alert-warning">No hay registros con los filtros seleccionados.</div>
    <?php endif; ?>
</div>
