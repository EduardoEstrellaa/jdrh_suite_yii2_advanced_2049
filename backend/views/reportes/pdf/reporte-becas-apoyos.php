<?php

use yii\helpers\Html;

$titulos = [
    'generacion' => ($filtros['generacionId'] ?? false)
        ? Html::encode($generaciones[$filtros['generacionId']] ?? 'No definido')
        : 'Todos',
    'tipoBeca' => ($filtros['tipoBecaId'] ?? false)
        ? Html::encode($tiposBecas[$filtros['tipoBecaId']] ?? 'No definido')
        : 'Todas',
    'ciclo' => ($filtros['cicloId'] ?? false)
        ? Html::encode($ciclos[$filtros['cicloId']] ?? 'No definido')
        : 'Todos',
];
$soloConBeca = !empty($filtros['soloConBeca']);
$totalAlumnos = count($datos);
?>

<div class="pdf-hero">
    <div>
        <p class="pdf-tag"><strong>Resumen</strong></p>
        <h2>Becas y apoyos estudiantiles</h2>
        <p class="pdf-subtitle">
            Filtros:
            Generacion <span class="pdf-subtitle__filter-value"><?= $titulos['generacion'] ?></span>
            &middot;
            Tipo <span class="pdf-subtitle__filter-value"><?= $titulos['tipoBeca'] ?></span>
            &middot;
            Ciclo <span class="pdf-subtitle__filter-value"><?= $titulos['ciclo'] ?></span>
        </p>
    </div>
    <div class="pdf-hero-meta">
        <p class="pdf-meta-label">Solo con beca</p>
        <p class="pdf-meta-value"><?= $soloConBeca ? 'SI' : 'NO' ?></p>
        <p class="pdf-meta-label">Actualizado</p>
        <p class="pdf-meta-value"><?= date('d/m/Y H:i') ?></p>
    </div>
</div>


<table class="pdf-summary-table">
    <tr>
        <td>
            <p class="pdf-meta-label">Total de alumnos</p>
            <strong><?= Html::encode($totalAlumnos) ?></strong>
        </td>
    </tr>
</table>

<?php if ($datos): ?>
    <div class="table-container">
        <table class="table-pdf">
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
                        <td><?= Html::encode($fila['nombre']) ?></td>
                        <td><?= Html::encode($fila['matricula']) ?></td>
                        <td><?= Html::encode($fila['generacion']) ?></td>
                        <td><?= Html::encode($fila['tipo']) ?></td>
                        <td><?= Html::encode($fila['estatus']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No hay registros disponibles.</p>
<?php endif; ?>


<?php if (!empty($chartImage)): ?>
    <div class="pdf-chart">
        <img src="data:image/png;base64,<?= Html::encode($chartImage) ?>" alt="Totales por tipo de beca">
    </div>
<?php endif; ?>
