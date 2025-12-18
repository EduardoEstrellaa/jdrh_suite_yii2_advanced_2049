<?php
$this->title = 'Expedientes de Alumnos';
?>

<div class="header">
    <h2>INSTITUCIÓN EDUCATIVA PÚBLICA DE YUCATÁN</h2>
    <h3>Control de Resguardos</h3>
    <p>Reporte: <strong>Expedientes de Alumnos</strong> | Fecha: <?= $fecha ?></p>
</div>

<button onclick="window.print()" class="btn-print">Imprimir / PDF</button>

<div style="border: 1px solid #ccc; padding: 20px; text-align: center; color: #666;">
    <h4>Sin Asignaciones Activas a Alumnos</h4>
    <p>Actualmente no se encuentran equipos asignados individualmente a estudiantes en la base de datos.</p>
    <small>Nota del sistema: Todos los activos se encuentran en departamentos administrativos o almacén.</small>
</div>