<?php
/* @var $this yii\web\View */
/* @var $equipos common\models\Equipos[] */

$this->title = 'Inventario General';
?>

<div class="header">
    <h2>INSTITUCIÓN EDUCATIVA PÚBLICA DE YUCATÁN</h2>
    <h3>Sistema de Gestión de Inventario</h3>
    <p>Reporte: <strong>Inventario General Completo</strong> | Fecha: <?= $fecha ?></p>
</div>

<button onclick="window.print()" class="btn-print">Imprimir / PDF</button>

<table>
    <thead>
        <tr>
            <th>Inventario</th>
            <th>Tipo</th>
            <th>Marca / Modelo</th>
            <th>Serie</th>
            <th>Estado</th>
            <th>Ubicación Actual</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipos as $equipo): ?>
        <tr>
            <td><?= $equipo->numero_inventario ?></td>
            <td><?= $equipo->tipoEquipo->descripcion ?? 'N/A' ?></td>
            <td>
                <?= $equipo->modelo->marca->descripcion ?? '' ?>
                <?= $equipo->modelo->descripcion ?? '' ?>
            </td>
            <td><?= $equipo->numero_serie ?></td>
            <td><?= $equipo->estadoEquipo->descripcion ?? '' ?></td>
            <td>
                <?php 
                if ($equipo->bajaEquipo) {
                    echo '<strong style="color:red">BAJA DEL SISTEMA</strong>';
                } elseif ($equipo->asignacion) {
                    echo $equipo->asignacion->departamento->descripcion ?? 'Sin Depto';
                } else {
                    echo 'En Almacén / Sin Asignar';
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>