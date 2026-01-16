<?php

use backend\forms\reportes\ForaneosEstudiantesReportRequest;
use common\helpers\InputHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$filter = $filter ?? new ForaneosEstudiantesReportRequest();
$pdfUrl = Url::to(array_merge(['foraneos'], Yii::$app->request->queryParams, ['format' => 'pdf']));
$this->registerCssFile('@web/css/reportes-foraneos.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);

$totalAlumnos = count($alumnos);
$totalMunicipios = count($municipios);
$totalGeneraciones = count($generaciones);
$generacionesOptions = $generacionesOptions ?? [];
$entidadesOptions = $entidadesOptions ?? [];
$municipiosOptions = $municipiosOptions ?? [];
?>

<div class="reportes-foraneos">
    <div class="reportes-foraneos__hero card shadow-sm mb-4">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3 align-items-start">
            <div>
                <h4 class="mb-1">Estudiantes foraneos</h4>
                <p class="text-muted mb-0">Alumnos cuyo domicilio registrado no corresponde a Valladolid. Usa los filtros para ajustar el periodo antes de exportar.</p>
            </div>
            <div class="reportes-foraneos__hero-cta">
                <a href="<?= Html::encode($pdfUrl) ?>" class="btn btn-outline-secondary btn-sm reportes-foraneos__btn">
                    <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                </a>
            </div>
        </div>
    </div>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to(['reportes/foraneos']),
        'options' => ['class' => 'card reportes-foraneos__filter-card shadow-sm mb-4'],
    ]); ?>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'generacion_id',
                        'fa-layer-group',
                        $generacionesOptions,
                        ['placeholder' => 'Generacion']
                    ) ?>
                </div>
                <div class="col-md-4">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'entidad_federativa_id',
                        'fa-map',
                        $entidadesOptions,
                        ['placeholder' => 'Entidad federativa']
                    ) ?>
                </div>
                <div class="col-md-4">
                    <?= InputHelper::iconSelect2Field(
                        $form,
                        $filter,
                        'municipio_id',
                        'fa-city',
                        $municipiosOptions,
                        [
                            'placeholder' => 'Municipio',
                            'options' => [
                                'class' => 'form-control',
                                'data-selected' => $filter->municipio_id,
                            ],
                        ]
                    ) ?>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-md-end reportes-foraneos__filter-actions mt-3">
                <button type="submit" class="btn btn-primary reportes-foraneos__btn">Aplicar filtros</button>
                <a href="<?= Url::to(['foraneos']) ?>" class="btn btn-outline-secondary reportes-foraneos__btn">Limpiar filtros</a>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

    <div class="row g-3 mb-4 reportes-foraneos__stats-row">
        <div class="col-md-4">
            <div class="card reportes-foraneos__stat-card border-primary shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Alumnos foraneos</p>
                    <h5 class="mb-0"><?= Html::encode($totalAlumnos) ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card reportes-foraneos__stat-card border-success shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Municipios distintos</p>
                    <h5 class="mb-0"><?= Html::encode($totalMunicipios) ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card reportes-foraneos__stat-card border-warning shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Generaciones</p>
                    <h5 class="mb-0"><?= Html::encode($totalGeneraciones) ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card reportes-foraneos__table-card shadow-sm">
        <div class="card-body p-0">
            <?php if ($alumnos): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0 reportes-foraneos__table">
                        <thead class="text-uppercase small">
                            <tr>
                                <th>Alumno</th>
                                <th>Matricula</th>
                                <th>Municipio</th>
                                <th>Generacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alumnos as $alumno): ?>
                                <?php
                                $perfil = $alumno->perfil;
                                $domicilio = $perfil ? $perfil->domiciliosActuales : null;
                                $municipio = $domicilio && $domicilio->municipios ? $domicilio->municipios->nombre : 'Sin municipio';
                                $nombreAlumno = $perfil ? ($perfil->nombreCompleto ?? trim($perfil->nombre . ' ' . $perfil->apellido)) : $alumno->matricula;
                                ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold"><?= Html::encode($nombreAlumno) ?></div>
                                    </td>
                                    <td><?= Html::encode($alumno->matricula) ?></td>
                                    <td><?= Html::encode($municipio) ?></td>
                                    <td><?= Html::encode($alumno->generaciones ? $alumno->generaciones->nombre : 'Sin generacion') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-4">
                    <div class="alert alert-warning mb-0">No hay estudiantes foraneos con los filtros seleccionados.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$entidadInputId = Html::getInputId($filter, 'entidad_federativa_id');
$municipioInputId = Html::getInputId($filter, 'municipio_id');
$municipiosUrl = Url::to(['reportes/municipios-por-entidad-federativa'], true);
$endpointJson = Json::encode($municipiosUrl);
$selectedMunicipioJson = Json::encode($filter->municipio_id);
$script = <<<JS
(function () {
    const entidadSelect = $('#$entidadInputId');
    const municipioSelect = $('#$municipioInputId');
    const endpoint = $endpointJson;
    const selectedMunicipio = $selectedMunicipioJson;
    const placeholderText = 'Selecciona un municipio';

    if (!entidadSelect.length || !municipioSelect.length) {
        return;
    }

    const resetMunicipioSelect = () => {
        municipioSelect.find('option').remove();
        municipioSelect.append(new Option(placeholderText, '', false, false));
        municipioSelect.val('').trigger('change.select2');
    };

    const loadMunicipios = (entidadId, selected) => {
        resetMunicipioSelect();
        municipioSelect.prop('disabled', true);

        if (!entidadId) {
            municipioSelect.prop('disabled', false);
            return;
        }

        const url = new URL(endpoint);
        url.searchParams.set('entidadId', entidadId);
        fetch(url.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then((response) => response.json())
            .then((data) => {
                const municipios = data.municipios ?? {};
                Object.entries(municipios).forEach(([value, label]) => {
                    const isSelected = selected && String(value) === String(selected);
                    municipioSelect.append(new Option(label, value, false, isSelected));
                });
                municipioSelect.prop('disabled', false);
                municipioSelect.trigger('change.select2');
            })
            .catch(() => {
                municipioSelect.prop('disabled', false);
            });
    };

    entidadSelect.on('change', function () {
        loadMunicipios(this.value);
    });

    if (entidadSelect.val()) {
        loadMunicipios(entidadSelect.val(), selectedMunicipio);
    }
})();
JS;
$this->registerJs($script);
?>
