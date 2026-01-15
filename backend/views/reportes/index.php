<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="reportes-index">
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title mb-1">Reportes oficiales</h4>
            <p class="text-muted mb-0">Selecciona el reporte oficial y utiliza los filtros para refinar la informacion antes de exportar a PDF.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body">
                    <p class="text-muted">Tutores asignados</p>
                    <h5 class="mb-0"><?= Html::encode($stats['tutores']) ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body">
                    <p class="text-muted">Grupos activos</p>
                    <h5 class="mb-0"><?= Html::encode($stats['grupos']) ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-body">
                    <p class="text-muted">Alumnos en reportes</p>
                    <h5 class="mb-0"><?= Html::encode($stats['alumnos']) ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <?php foreach ($reports as $report): ?>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div>
                            <h5 class="card-title"><?= Html::encode($report['titulo']) ?></h5>
                            <p class="text-muted small mb-3"><?= Html::encode($report['descripcion']) ?></p>
                        </div>
                        <div class="mt-auto">
                            <a href="<?= Url::to(array_merge($report['ruta'], ['format' => 'pdf'])) ?>" class="btn btn-outline-secondary btn-sm me-2">Exportar PDF</a>
                            <a href="<?= Url::to($report['ruta']) ?>" class="btn btn-primary btn-sm">Abrir reporte</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
