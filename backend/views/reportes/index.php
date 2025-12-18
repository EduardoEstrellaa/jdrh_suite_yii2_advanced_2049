<?php
use yii\helpers\Url;

$this->title = 'Centro de Reportes';
?>

<div class="reportes-index">

    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Selecciona un tipo de reporte</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="ri-computer-line ri-3x text-primary mb-3"></i>1
                    <h5 class="card-title">Inventario General</h5>
                    <p class="card-text">
                        Listado completo de todos los equipos registrados, incluyendo marcas y modelos.
                    </p>
                    <a href="<?= Url::to(['/reportes/general']) ?>" class="btn btn-primary">
                        Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="ri-building-4-fill" style="font-size: 40px; color: #f59e0b;"></i>
                    <h5 class="card-title">Equipos por Departamentos</h5>
                    <p class="card-text">
                        Visualiza cuántos equipos están funcionales, en reparación o dados de baja.
                    </p>
                    <a href="<?= Url::to(['/reportes/estado']) ?>" class="btn btn-info text-white">
                        Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="ri-file-user-line ri-3x text-success mb-3"></i>
                    <h5 class="card-title">Expedientes de Alumnos</h5>
                    <p class="card-text">
                        Reporte detallado sobre qué alumnos tienen equipos asignados actualmente.
                    </p>
                    <a href="<?= Url::to(['/reportes/expedientes']) ?>" class="btn btn-success">
                        Ver Reporte
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>