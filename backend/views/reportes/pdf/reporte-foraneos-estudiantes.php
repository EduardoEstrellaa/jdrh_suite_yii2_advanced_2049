<?php

use yii\helpers\Html;

$nombreGeneracion = ($filtros['generacionId'] ?? false)
    ? ($generacionesOptions[$filtros['generacionId']] ?? 'No definido')
    : 'Todos';
$nombreEntidad = ($filtros['entidadFederativaId'] ?? false)
    ? ($entidadesOptions[$filtros['entidadFederativaId']] ?? 'No definido')
    : 'Todas';
$nombreMunicipio = ($filtros['municipioId'] ?? false)
    ? ($municipiosOptions[$filtros['municipioId']] ?? 'No definido')
    : 'Todos';
$totalGeneraciones = count($generaciones);
$generacionesOptions = $generacionesOptions ?? [];
$entidadesOptions = $entidadesOptions ?? [];
$municipiosOptions = $municipiosOptions ?? [];
?>

<div class="pdf-hero">
    <div>
        <p class="pdf-tag"><strong>Resumen</strong></p>
        <h2>Estudiantes foráneos</h2>
        <p class="pdf-subtitle">
            Filtros:
            Generación <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreGeneracion) ?></span>
            &middot;
            Entidad federativa <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreEntidad) ?></span>
            &middot;
            Municipio <span class="pdf-subtitle__filter-value"><?= Html::encode($nombreMunicipio) ?></span>
        </p>
    </div>
    <div class="pdf-hero-meta">
        <p class="pdf-meta-label">Actualizado</p>
        <p class="pdf-meta-value"><?= date('d/m/Y H:i') ?></p>
    </div>
</div>

<?php if ($generaciones): ?>
    <div class="table-container">
        <table class="table-pdf">
            <thead>
                <tr>
                    <th>Generación</th>
                    <th>Alumnos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($generaciones as $nombre => $conteo): ?>
                    <tr>
                        <td><?= Html::encode($nombre) ?></td>
                        <td><?= Html::encode($conteo) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if ($alumnos): ?>
    <div class="table-container">
        <table class="table-pdf">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Matricula</th>
                    <th>Municipio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $alumno): ?>
                    <?php
                    $perfil = $alumno->perfil;
                    $domicilio = $perfil ? $perfil->domiciliosActuales : null;
                    $municipio = $domicilio && $domicilio->municipios ? $domicilio->municipios->nombre : 'Sin municipio';
                    $nombreAlumno = $perfil ? ($perfil->nombreCompleto ?? trim($perfil->nombre . ' ' . $perfil->apellido)) : $alumno->matricula;
                    ?>
                    <tr>
                        <td><?= Html::encode($nombreAlumno) ?></td>
                        <td><?= Html::encode($alumno->matricula) ?></td>
                        <td><?= Html::encode($municipio) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
