<?php

use yii\helpers\Html;

$nombreCiclo = ($filtros['cicloId'] ?? false)
    ? ($ciclos[$filtros['cicloId']] ?? 'No definido')
    : 'Todos';
$nombreGrupo = ($filtros['grupoId'] ?? false)
    ? ($grupos[$filtros['grupoId']] ?? 'Todos')
    : 'Todos';
$nombreTipo = ($filtros['nivelRiesgo'] ?? false)
    ? ($nivelesRiesgo[$filtros['nivelRiesgo']] ?? 'Todos')
    : 'Todos';
$serioSemaforo = $semaforo ?? [];
$nivelColors = [
    'amarillo' => '#f97316',
    'rojo' => '#dc2626',
    'sin_consumo' => '#10b981',
];
?>

<div class="pdf-hero">
    <div>
        <p class="pdf-tag"><strong>Resumen</strong></p>
        <h2>Canalización de alumnos en riesgo</h2>
            <p class="pdf-subtitle">
                Filtros:
                Ciclo <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreCiclo) ?></span>
                &middot;
                Grupo <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreGrupo) ?></span>
                &middot;
                Tipo de riesgo <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreTipo) ?></span>
            </p>
    </div>
    <div class="pdf-hero-meta">
        <p class="pdf-meta-label">Actualizado</p>
        <p class="pdf-meta-value"><?= date('d/m/Y H:i') ?></p>
    </div>
</div>

<?php $verdePdf = ($serioSemaforo['verde'] ?? 0) + ($serioSemaforo['sin_consumo'] ?? 0); ?>
<table class="pdf-summary-table">
    <tr>
        <td>
            <p class="pdf-meta-label">Semáforo verde</p>
            <strong><?= Html::encode($verdePdf) ?></strong>
        </td>
        <td>
            <p class="pdf-meta-label">Semáforo amarillo</p>
            <strong><?= Html::encode($serioSemaforo['amarillo'] ?? 0) ?></strong>
        </td>
        <td>
            <p class="pdf-meta-label">Semáforo rojo</p>
            <strong><?= Html::encode($serioSemaforo['rojo'] ?? 0) ?></strong>
        </td>
    </tr>
</table>

<?php if ($items): ?>
    <div class="table-container">
        <table class="table-pdf">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Grupo</th>
                    <th>Nivel</th>
                    <th>Hábitos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $fila): ?>
                    <tr>
                        <td><?= Html::encode($fila['nombre']) ?></td>
                        <td>
                            <span style="<?= $fila['grupo'] === 'No asignado' ? 'color:#9ca3af;' : '' ?>">
                                <?= Html::encode($fila['grupo']) ?>
                            </span>
                        </td>
                        <td>
                            <span style="color:#fff;background:<?= $nivelColors[$fila['nivel']] ?? '#6b7280' ?>;padding:0.15rem 0.5rem;border-radius:999px;font-size:0.75rem;display:inline-block;">
                                <?= Html::encode($fila['etiqueta']) ?>
                            </span>
                        </td>
                        <td><?= Html::encode(implode(', ', $fila['motivos'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No hay registros para mostrar.</p>
<?php endif; ?>
