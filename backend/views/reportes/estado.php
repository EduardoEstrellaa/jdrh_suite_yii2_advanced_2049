<?php
$this->title = 'Equipos por Departamento';
?>

<div class="header">
    <h2>INSTITUCIÓN EDUCATIVA PÚBLICA DE YUCATÁN</h2>
    <h3>Distribución de Activos</h3>
    <p>Reporte: <strong>Equipos por Departamentos</strong> | Fecha: <?= $fecha ?></p>
</div>

<button onclick="window.print()" class="btn-print">Imprimir / PDF</button>

<div style="margin-bottom: 20px;">
    <strong>Resumen:</strong> Total Activos: <?= $total ?> | Bajas Totales: <?= $bajas ?>
</div>

<?php foreach ($departamentos as $depto): ?>
<?php if (count($depto->asignacions) > 0): ?>
<h4 style="margin-top: 30px; background: #eee; padding: 10px;"><?= strtoupper($depto->descripcion) ?></h4>
<table>
    <thead>
        <tr>
            <th>Inventario</th>
            <th>Equipo</th>
            <th>Serie</th>
            <th>Fecha Asignación</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($depto->asignacions as $asig): ?>
        <?php if ($asig->equipo): ?>
        <tr>
            <td><?= $asig->equipo->numero_inventario ?></td>
            <td>
                <?= $asig->equipo->tipoEquipo->descripcion ?? '' ?> -
                <?= $asig->equipo->modelo->descripcion ?? '' ?>
            </td>
            <td><?= $asig->equipo->numero_serie ?></td>
            <td><?= date('d/m/Y', strtotime($asig->fecha_asignacion)) ?></td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
<?php endforeach; ?>