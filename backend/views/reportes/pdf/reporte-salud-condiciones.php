<?php

use backend\services\reportes\ReportFormatter;
use yii\helpers\Html;

$formatter = new ReportFormatter();

?>
<?php $detalleTexto = static fn(array $valores, string $fallback) => Html::encode($valores ? implode(', ', $valores) : $fallback); ?>

<div class="pdf-hero">
    <div>
        <h2>Historial de salud y condiciones especiales</h2>
        <p class="pdf-subtitle">Reporte consolidado que identifica alergias, enfermedades crónicas y tratamientos activos por alumno.</p>
    </div>
    <div class="pdf-hero-meta">
        <p class="pdf-meta-label">Resumen actual</p>
        <strong><?= Html::encode($resumen['total'] ?? 0) ?> alumnos</strong>
        <span class="pdf-meta-value"><?= Html::encode($resumen['con_condicion'] ?? 0) ?> con condición activa</span>
    </div>
</div>

<?php if ($alumno): ?>
    <?php $detallesAlumno = $formatter->extraerDetalladoSalud($alumno); ?>
    <article class="pdf-card">
        <header class="pdf-card-header">
            <div>
                <p class="pdf-tag">Alumno individual</p>
                <h3><?= Html::encode($alumno->perfil ? $alumno->perfil->nombreCompleto : $alumno->matricula) ?></h3>
                <p class="pdf-subtitle">Matrícula <?= Html::encode($alumno->matricula ?? 'Sin matrícula') ?></p>
            </div>
        </header>
        <div class="pdf-detail-block">
            <div>
                <p class="pdf-detail-label">Problemas de salud</p>
                <p class="pdf-detail-text"><?= $detalleTexto($detallesAlumno['problemas_salud'] ?? [], 'Sin registros') ?></p>
            </div>
            <div>
                <p class="pdf-detail-label">Enfermedades crónicas</p>
                <p class="pdf-detail-text"><?= $detalleTexto($detallesAlumno['cronicas'] ?? [], 'Sin registros documentados') ?></p>
            </div>
            <div>
                <p class="pdf-detail-label">Alergias</p>
                <p class="pdf-detail-text"><?= $detalleTexto($detallesAlumno['alergias'] ?? [], 'Sin datos') ?></p>
            </div>
            <div>
                <p class="pdf-detail-label">Tratamientos</p>
                <p class="pdf-detail-text"><?= $detalleTexto($detallesAlumno['tratamientos'] ?? [], 'Sin tratamientos activos') ?></p>
            </div>
            <div>
                <p class="pdf-detail-label">Servicios y apoyos</p>
                <p class="pdf-detail-text"><?= $detalleTexto($detallesAlumno['servicios'] ?? [], 'Sin servicios asociados') ?></p>
            </div>
        </div>
    </article>
<?php else: ?>
    <table class="pdf-summary-table">
        <tr>
            <td>
                <p class="pdf-summary-label">Alumnos totales</p>
                <strong><?= Html::encode($resumen['total'] ?? 0) ?></strong>
            </td>
            <td>
                <p class="pdf-summary-label">Con condición activa</p>
                <strong><?= Html::encode($resumen['con_condicion'] ?? 0) ?></strong>
            </td>
            <td>
                <p class="pdf-summary-label">Diagnósticos de salud</p>
                <strong><?= Html::encode($resumen['problemas_salud'] ?? 0) ?></strong>
            </td>
            <td>
                <p class="pdf-summary-label">Enfermedades crónicas</p>
                <strong><?= Html::encode($resumen['cronicas'] ?? 0) ?></strong>
            </td>
        </tr>
    </table>

    <?php if ($items): ?>
        <?php foreach ($items as $registro): ?>
            <?php
                $detallesRegistro = $registro['detalles_salud'] ?? [];
                $condicionActiva = in_array('SI', [$registro['salud'], $registro['cronicas'], $registro['alergias'], $registro['tratamientos']], true);
            ?>
            <article class="pdf-alumno-card">
                <header class="pdf-card-header">
                    <div>
                        <p class="pdf-tag">Alumno</p>
                        <h3><?= Html::encode($registro['nombre']) ?></h3>
                        <p class="pdf-subtitle">Matrícula <?= Html::encode($registro['matricula']) ?></p>
                    </div>
                </header>
            <div class="pdf-detail-block">
                <div>
                    <p class="pdf-detail-label">Problemas de salud</p>
                    <p class="pdf-detail-text"><?= $detalleTexto($detallesRegistro['problemas_salud'] ?? [], 'Sin registros documentados') ?></p>
                </div>
                <div>
                    <p class="pdf-detail-label">Enfermedades crónicas</p>
                    <p class="pdf-detail-text"><?= $detalleTexto($detallesRegistro['cronicas'] ?? [], 'No documentadas') ?></p>
                </div>
                <div>
                    <p class="pdf-detail-label">Alergias</p>
                    <p class="pdf-detail-text"><?= $detalleTexto($detallesRegistro['alergias'] ?? [], 'Ninguna registrada') ?></p>
                </div>
                <div>
                    <p class="pdf-detail-label">Tratamientos</p>
                    <p class="pdf-detail-text"><?= $detalleTexto($detallesRegistro['tratamientos'] ?? [], 'Sin tratamiento activo') ?></p>
                </div>
                <div>
                    <p class="pdf-detail-label">Servicios</p>
                    <p class="pdf-detail-text"><?= $detalleTexto($detallesRegistro['servicios'] ?? [], 'Sin servicios asociados') ?></p>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay registros para los filtros indicados.</p>
    <?php endif; ?>
<?php endif; ?>
