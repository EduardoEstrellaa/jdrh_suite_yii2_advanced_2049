<?php

use yii\helpers\Html;

$nombreCiclo = ($filtros['cicloId'] ?? false)
    ? ($ciclos[$filtros['cicloId']] ?? 'No definido')
    : 'Todos';
$nombreSemestre = ($filtros['semestreId'] ?? false)
    ? ($semestres[$filtros['semestreId']] ?? 'No definido')
    : 'Todos';
$nombreGrupo = ($filtros['grupoId'] ?? false)
    ? ($grupos[$filtros['grupoId']] ?? 'No definido')
    : 'Todos';
$nombreTutor = ($filtros['tutorId'] ?? false)
    ? ($tutores[$filtros['tutorId']] ?? 'No definido')
    : 'Todos';

$totalGrupos = $totales['grupos'] ?? 0;
$totalTutores = $totales['tutores'] ?? 0;
$totalAlumnosAsignados = $totales['alumnos'] ?? 0;

?>

<div class="pdf-hero">
    <div>
        <p class="pdf-tag"><strong>Resumen</strong></p>
        <h2>Asignacion de tutores, grupos y alumnos</h2>
        <p class="pdf-subtitle">
            Filtros:
            Ciclo <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreCiclo) ?></span>
            &middot;
            Semestre <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreSemestre) ?></span>
            &middot;
            Grupo <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreGrupo) ?></span>
            &middot;
            Tutor <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreTutor) ?></span>
        </p>
    </div>
    <div class="pdf-hero-meta">
        <p class="pdf-meta-label">Actualizado</p>
        <p class="pdf-meta-value"><?= date('d/m/Y H:i') ?></p>
    </div>
</div>

<div class="pdf-summary-grid">
    <div class="pdf-summary-card pdf-summary-card--tutores">
        <p class="pdf-summary-label">Tutores visibles</p>
        <strong><?= Html::encode($totalTutores) ?></strong>
    </div>
    <div class="pdf-summary-card pdf-summary-card--grupos">
        <p class="pdf-summary-label">Grupos listados</p>
        <strong><?= Html::encode($totalGrupos) ?></strong>
    </div>
    <div class="pdf-summary-card pdf-summary-card--alumnos">
        <p class="pdf-summary-label">Alumnos agrupados</p>
        <strong><?= Html::encode($totalAlumnosAsignados) ?></strong>
    </div>
</div>

<?php if ($tabla): ?>
    <p class="pdf-section-title">Detalle de tutores y grupos</p>
    <div class="table-container">
        <table class="table-pdf">
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th>Grupo</th>
                    <th>Semestre</th>
                    <th>Alumnos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tabla as $fila): ?>
                    <tr>
                        <td><?= Html::encode($fila['tutor']) ?></td>
                        <td><?= Html::encode($fila['grupo']) ?></td>
                        <td><?= Html::encode($fila['semestre']) ?></td>
                        <td><?= Html::encode($fila['conteo']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="pdf-section-title">Detalle de tutores y grupos</p>
    <p>No hay registros para los filtros indicados.</p>
<?php endif; ?>
