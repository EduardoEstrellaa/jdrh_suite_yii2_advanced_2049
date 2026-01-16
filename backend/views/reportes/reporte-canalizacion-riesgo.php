<?php

use backend\forms\reportes\RiesgoCanalizacionReportRequest;
use common\helpers\InputHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$filter = $filter ?? new RiesgoCanalizacionReportRequest();
$pdfUrl = Url::to(array_merge(['riesgo'], Yii::$app->request->queryParams, ['format' => 'pdf']));
$this->registerCssFile('@web/css/reportes-riesgo.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
?>

<div class="reportes-riesgo">
    <div class="reportes-riesgo__hero card shadow-sm mb-4">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3 align-items-start">
            <div>
                <h4 class="mb-1">Canalización de alumnos en riesgo</h4>
                <p class="text-muted mb-0">Índice global 0-100 con ponderaciones para priorizar intervenciones.</p>
            </div>
            <div class="reportes-riesgo__hero-cta">
                <a href="<?= Html::encode($pdfUrl) ?>" class="btn btn-outline-secondary btn-sm reportes-riesgo__btn">
                    <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                </a>
            </div>
        </div>
    </div>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to(['reportes/riesgo']),
        'options' => ['class' => 'card reportes-riesgo__filter-card shadow-sm mb-4'],
    ]); ?>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-3 col-md-4">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'ciclo_escolar_id',
                        'fa-calendar-alt',
                        $ciclos,
                        ['placeholder' => 'Ciclo escolar', 'options' => ['value' => $filter->ciclo_escolar_id]]
                    ) ?>
                </div>
                <div class="col-lg-3 col-md-4">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'grupo_id',
                        'fa-users',
                        $grupos,
                        ['placeholder' => 'Grupo', 'options' => ['value' => $filter->grupo_id]]
                    ) ?>
                </div>
                <div class="col-lg-3 col-md-4">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'nivel_riesgo',
                        'fa-biohazard',
                        $nivelesRiesgo,
                        ['placeholder' => 'Nivel de riesgo', 'options' => ['value' => $filter->nivel_riesgo]]
                    ) ?>
                </div>
                <div class="col-lg-3 col-md-12 d-flex align-items-end justify-content-md-end">
                    <div class="d-flex flex-wrap gap-2 reportes-riesgo__filter-actions">
                        <button type="submit" class="btn btn-primary reportes-riesgo__btn">Aplicar filtros</button>
                        <a href="<?= Url::to(['riesgo']) ?>" class="btn btn-outline-secondary reportes-riesgo__btn">Limpiar filtros</a>
                    </div>
                </div>
            </div>
        </div>
<?php ActiveForm::end(); ?>

<?php
$cicloId = Html::getInputId($filter, 'ciclo_escolar_id');
$grupoId = Html::getInputId($filter, 'grupo_id');
$nivelId = Html::getInputId($filter, 'nivel_riesgo');
$cicloValue = Json::encode($filter->ciclo_escolar_id);
$grupoValue = Json::encode($filter->grupo_id);
$nivelValue = Json::encode($filter->nivel_riesgo);
$js = <<<JS
(function() {
    const cicloInput = $('#$cicloId');
    const grupoInput = $('#$grupoId');
    const nivelInput = $('#$nivelId');

    const applySelected = (input, value) => {
        if (!value && value !== 0 && value !== '0') {
            return;
        }
        input.val(value).trigger('change');
    };

    applySelected(cicloInput, $cicloValue);
    applySelected(grupoInput, $grupoValue);
    applySelected(nivelInput, $nivelValue);
})();
JS;
$this->registerJs($js);
?>

    <div class="row g-3 mb-4 reportes-riesgo__stats-row">
        <?php $verdeTotal = ($semaforo['verde'] ?? 0) + ($semaforo['sin_consumo'] ?? 0); ?>
        <div class="col-md-4">
            <div class="card reportes-riesgo__stat-card reportes-riesgo__stat-card--verde shadow-sm h-100">
                <div class="card-body">
                    <p class="reportes-riesgo__stat-label mb-1">Semaforo verde</p>
                    <h5 class="reportes-riesgo__stat-value mb-0"><?= Html::encode($verdeTotal) ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card reportes-riesgo__stat-card reportes-riesgo__stat-card--amarillo shadow-sm h-100">
                <div class="card-body">
                    <p class="reportes-riesgo__stat-label mb-1">Semaforo amarillo</p>
                    <h5 class="reportes-riesgo__stat-value mb-0"><?= Html::encode($semaforo['amarillo'] ?? 0) ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card reportes-riesgo__stat-card reportes-riesgo__stat-card--rojo shadow-sm h-100">
                <div class="card-body">
                    <p class="reportes-riesgo__stat-label mb-1">Semaforo rojo</p>
                    <h5 class="reportes-riesgo__stat-value mb-0"><?= Html::encode($semaforo['rojo'] ?? 0) ?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card reportes-riesgo__table-card shadow-sm">
        <div class="card-body p-0">
            <?php if ($items): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0 reportes-riesgo__table">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Grupo</th>
                                <th>Nivel</th>
                                <th>Hábitos detectados</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $fila): ?>
                                <tr>
                                    <td><?= Html::encode($fila['nombre']) ?></td>
                                    <td class="<?= $fila['grupo'] === 'No asignado' ? 'reportes-riesgo__no-grupo text-muted' : '' ?>">
                                        <?= Html::encode($fila['grupo']) ?>
                                    </td>
                                    <td>
                                        <?php
                                        $clase = 'success';
                                        if ($fila['nivel'] === 'amarillo') {
                                            $clase = 'warning';
                                        } elseif ($fila['nivel'] === 'rojo') {
                                            $clase = 'danger';
                                        }
                                        ?>
                                        <span class="badge bg-<?= $clase ?> text-uppercase reportes-riesgo__badge">
                                            <?= Html::encode($fila['etiqueta']) ?>
                                        </span>
                                    </td>
                                    <td><?= Html::encode(implode(', ', $fila['motivos'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end p-3">
                    <?= LinkPager::widget(['pagination' => $paginas]) ?>
                </div>
            <?php else: ?>
                <div class="p-4">
                    <div class="alert alert-warning mb-0">No hay alumnos en riesgo con los filtros actuales.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
