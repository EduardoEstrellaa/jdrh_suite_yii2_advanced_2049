<?php

use backend\forms\reportes\SaludCondicionesReportRequest;
use common\helpers\InputHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$pdfUrl = Url::to(array_merge(['salud'], Yii::$app->request->queryParams, ['format' => 'pdf']));
$filter = $filter ?? new SaludCondicionesReportRequest();
$this->registerCssFile('@web/css/reportes-salud-condiciones.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
?>
<div class="reportes-salud">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap reportes-salud__hero">
        <div>
            <h4 class="mb-1">Historial de salud y condiciones especiales</h4>
            <p class="text-muted mb-0">Concentra las alertas de salud, alergias y tratamientos por alumno, apoyado con filtros avanzados.</p>
        </div>
        <div class="mt-2">
            <a href="<?= Html::encode($pdfUrl) ?>" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-file-pdf me-1"></i> Exportar PDF
            </a>
        </div>
    </div>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to(['reportes/salud']),
        'options' => ['class' => 'card card-body shadow-sm mb-4 reportes-salud__filter-panel'],
    ]); ?>
        <div class="row g-3">
            <div class="col-lg-4 col-md-6">
                <?= InputHelper::iconSelect2Field(
                    $form,
                    $filter,
                    'grupo_id',
                    'fa-users',
                    $grupos,
                    ['placeholder' => 'Grupo'],
                    ['allowClear' => true]
                ) ?>
            </div>
            <div class="col-lg-4 col-md-6">
                <?= InputHelper::iconSelect2Field(
                    $form,
                    $filter,
                    'problema_id',
                    'fa-notes-medical',
                    $problemasSalud,
                    ['placeholder' => 'Selecciona un problema'],
                    ['allowClear' => true]
                ) ?>
            </div>
            <div class="col-lg-4 col-md-6">
                <?= InputHelper::iconTextField(
                    $form,
                    $filter,
                    'matricula',
                    'fa-id-card',
                    ['inputOptions' => ['placeholder' => 'Matrícula del alumno']]
                ) ?>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-4 col-md-6">
                <?= InputHelper::iconSelect2Field(
                    $form,
                    $filter,
                    'cronica_id',
                    'fa-heartbeat',
                    $cronicas,
                    ['placeholder' => 'Selecciona una enfermedad crónica'],
                    ['allowClear' => true]
                ) ?>
            </div>
            <div class="col-lg-4 col-md-6">
                <?= InputHelper::iconSelect2Field(
                    $form,
                    $filter,
                    'alergia_id',
                    'fa-allergies',
                    $alergias,
                    ['placeholder' => 'Selecciona una alergia'],
                    ['allowClear' => true]
                ) ?>
            </div>
            <div class="col-lg-4 col-md-6">
                <?= InputHelper::iconSelect2Field(
                    $form,
                    $filter,
                    'tratamiento_id',
                    'fa-pills',
                    $tratamientos,
                    ['placeholder' => 'Selecciona un tratamiento'],
                    ['allowClear' => true]
                ) ?>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 border-top mt-4 pt-3">
            <button type="submit" class="btn btn-primary px-4 reportes-salud__btn-primary">Aplicar filtros</button>
            <a href="<?= Url::to(['reportes/salud']) ?>" class="btn btn-outline-primary px-4 reportes-salud__btn-outline">Limpiar filtros</a>
        </div>
    <?php ActiveForm::end(); ?>

    <?php if (!$filter->grupo_id && !$filter->problema_id && !$filter->matricula): ?>
        <?php
        $countCards = [
            ['label' => 'Alumnos totales', 'value' => $resumen['total'] ?? 0],
            ['label' => 'Alumnos totales con condición', 'value' => $resumen['con_condicion'] ?? 0],
            ['label' => 'Con problemas de salud', 'value' => $resumen['problemas_salud'] ?? 0],
            ['label' => 'Enfermedades crónicas', 'value' => $resumen['cronicas'] ?? 0],
            ['label' => 'Alergias', 'value' => $resumen['alergias'] ?? 0],
            ['label' => 'En tratamiento', 'value' => $resumen['tratamientos'] ?? 0],
        ];
        ?>
        <div class="reportes-salud__counts-grid mb-4">
            <?php foreach ($countCards as $card): ?>
            <article class="card card-body shadow-sm h-100 reportes-salud__count-card">
                <div class="reportes-salud__count-content">
                    <p class="text-uppercase text-muted small mb-1 reportes-salud__count-label"><?= Html::encode($card['label']) ?></p>
                    <div class="reportes-salud__count-value">
                        <h4 class="fw-bold mb-0"><?= Html::encode($card['value']) ?></h4>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if ($alumno): ?>
        <?php
        $estadoSalud = is_array($alumno->alumEstadoSaluds) ? ($alumno->alumEstadoSaluds[0] ?? null) : $alumno->alumEstadoSaluds;
        $collectNames = static function (iterable $collection, ?callable $extract = null) {
            $nombres = [];
            foreach ($collection as $item) {
                if ($extract) {
                    $values = $extract($item);
                    if (is_iterable($values)) {
                        foreach ($values as $value) {
                            $nombres[] = $value ?? 'Sin nombre';
                        }
                    } elseif ($values) {
                        $nombres[] = $values ?? 'Sin nombre';
                    }
                    continue;
                }

                $nombres[] = $item->nombre ?? 'Sin nombre';
            }
            return array_unique(array_filter($nombres));
        };
        $cronicasDetalle = $collectNames($alumno->alumEnfermedadesCronicas, fn($item) => array_filter(array_map(
            fn($entry) => $entry->catalogoEnfermCronicas?->nombre ?? $entry->otro_especificar ?? null,
            $item->enfermedadesCronicas ?? []
        )));
        $alergiasDetalle = $collectNames($alumno->alumAlergias, fn($item) => array_filter(array_map(
            fn($entry) => $entry->catalogoAlergias?->nombre ?? null,
            $item->alergias ?? []
        )));
        $tratamientosDetalle = $collectNames($alumno->alumTratamientos, fn($item) => array_filter(array_map(
            fn($entry) => $entry->catalogoTratamientos?->nombre ?? null,
            $item->tratamientos ?? []
        )));
        $serviciosDetalle = $collectNames(
            $alumno->alumServiciosSalud ? [$alumno->alumServiciosSalud] : [],
            fn($item) => array_filter(array_map(
            fn($entry) => $entry->catalogoServiciosSalud?->nombre ?? null,
            $item->serviciosSaluds ?? []
        )));
        $problemasDetalle = $collectNames($estadoSalud ? $estadoSalud->problemasSaluds : [], fn($item) => array_filter(array_map(
            fn($entry) => $entry->catalogoProblemasSalud?->nombre ?? null,
            [$item]
        )));
        $statusItems = [
            [
                'label' => 'Cuenta con problemas de salud',
                'relation' => $estadoSalud,
                'attribute' => 'tuvo_problema_salud',
                'hint' => 'El alumno reportó alguna condición relevante.',
                'details' => $problemasDetalle,
            ],
            [
                'label' => 'Reporta enfermedades crónicas',
                'relation' => $alumno->alumEnfermedadesCronicas,
                'attribute' => 'padece_enfermedades_cronicas',
                'hint' => 'Incluye diagnósticos crónicos documentados.',
                'details' => $cronicasDetalle,
            ],
            [
                'label' => 'Reporta alergias',
                'relation' => $alumno->alumAlergias,
                'attribute' => 'padeces_alergias',
                'hint' => 'Se marca si se registraron alergias.',
                'details' => $alergiasDetalle,
            ],
            [
                'label' => 'Está en tratamiento',
                'relation' => $alumno->alumTratamientos,
                'attribute' => 'esta_en_tratamiento',
                'hint' => 'Muestra tratamientos activos en expediente.',
                'details' => $tratamientosDetalle,
            ],
            [
                'label' => 'Servicios de salud documentados',
                'relation' => $alumno->alumServiciosSalud,
                'attribute' => 'tiene_servicios_salud',
                'hint' => 'Indica si hay servicios vinculados.',
                'details' => $serviciosDetalle,
            ],
        ];

        $extractStatus = static function ($relation, string $attribute) {
            if (is_array($relation)) {
                $entity = $relation[0] ?? null;
            } else {
                $entity = $relation;
            }
            return (bool)($entity->{$attribute} ?? false);
        };

        ?>
        <div class="card reportes-salud__profile shadow-sm mb-4">
            <div class="reportes-salud__profile-header">
                <div>
                    <p class="text-muted mb-1">Ficha de <?= Html::encode($alumno->perfil ? $alumno->perfil->nombreCompleto : $alumno->matricula) ?></p>
                    <h5 class="fw-bold mb-0"><?= Html::encode($alumno->matricula ?? 'Sin matrícula') ?></h5>
                </div>
                <span class="badge bg-dark text-white reportes-salud__profile-badge">Expediente completo</span>
            </div>
            <div class="reportes-salud__status-grid">
                <?php foreach ($statusItems as $item): ?>
                    <?php $flag = $extractStatus($item['relation'], $item['attribute']); ?>
                    <article class="reportes-salud__status-card">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0"><?= Html::encode($item['label']) ?></h6>
                            <span class="badge <?= $flag ? 'bg-success' : 'bg-danger' ?> text-white">
                                <?= $flag ? 'SI' : 'NO' ?>
                            </span>
                        </div>
                        <p class="text-muted small mb-0"><?= Html::encode($item['hint']) ?></p>
                        <?php if (!empty($item['details'])): ?>
                            <p class="text-muted small mb-0 mt-2">
                                <strong><?= Html::encode($item['label']) ?> registrados:</strong>
                                <?= Html::encode(implode(', ', $item['details'])) ?>
                            </p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!$filter->matricula): ?>
        <div class="card shadow-sm reportes-salud__table-card">
            <div class="card-body p-0">
                <?php if ($items): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless align-middle mb-0 table-reportes">
                            <thead class="table-light">
                                <tr>
                                    <th>Alumno registrado</th>
                                    <th>Matrícula oficial</th>
                                    <th>Cuenta con problemas de salud</th>
                                    <th>Reporta enfermedades crónicas</th>
                                    <th>Reporta alergias</th>
                                    <th>Está en tratamiento</th>
                                    <th>Servicios de salud disponibles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $registro): ?>
                                    <tr>
                                        <td><?= Html::encode($registro['nombre']) ?></td>
                                        <td><?= Html::encode($registro['matricula']) ?></td>
                                    <td><span class="badge <?= $registro['salud'] === 'SI' ? 'bg-danger text-white' : 'bg-info text-white' ?>"><?= Html::encode($registro['salud']) ?></span></td>
                                    <td><span class="badge <?= $registro['cronicas'] === 'SI' ? 'bg-danger text-white' : 'bg-info text-white' ?>"><?= Html::encode($registro['cronicas']) ?></span></td>
                                    <td><span class="badge <?= $registro['alergias'] === 'SI' ? 'bg-danger text-white' : 'bg-info text-white' ?>"><?= Html::encode($registro['alergias']) ?></span></td>
                                    <td><span class="badge <?= $registro['tratamientos'] === 'SI' ? 'bg-danger text-white' : 'bg-info text-white' ?>"><?= Html::encode($registro['tratamientos']) ?></span></td>
                                    <td><span class="badge <?= $registro['servicios'] === 'SI' ? 'bg-danger text-white' : 'bg-info text-white' ?>"><?= Html::encode($registro['servicios']) ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($paginas): ?>
                        <div class="card-footer bg-white border-0 d-flex justify-content-end">
                            <?= LinkPager::widget(['pagination' => $paginas]) ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="p-4">
                        <div class="alert alert-warning mb-0">No hay alumnos que cumplan el filtro seleccionado.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
