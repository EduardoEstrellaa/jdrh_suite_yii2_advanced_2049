<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="expediente-view">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-folder-open text-primary"></i>
            <?= Html::encode($this->title) ?>
        </h1>

        <div>
            <?= Html::a('<i class="fas fa-arrow-left"></i> Volver', ['index'], ['class' => 'btn btn-secondary']) ?>
            <?= Html::a('<i class="fas fa-edit"></i> Editar', ['update', 'id' => $alumno->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> Eliminar', ['delete', 'id' => $alumno->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estás seguro de que quieres eliminar este expediente completo?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <!-- ===================== -->
    <!-- 📌 ACORDEÓN PRINCIPAL -->
    <!-- ===================== -->
    <div class="accordion" id="expedienteAccordionView">

        <!-- ===================== -->
        <!-- SECCIÓN 1: DATOS ACADÉMICOS -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAcademicos">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademicos" aria-expanded="true">
                    📚 I. DATOS ACADÉMICOS
                </button>
            </h2>

            <div id="collapseAcademicos" class="accordion-collapse collapse show" aria-labelledby="headingAcademicos">
                <div class="accordion-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Matrícula</th>
                            <td><?= $alumno->matricula ?></td>
                        </tr>
                        <tr>
                            <th>Licenciatura</th>
                            <td><?= $alumno->planLicenciaturas->licenciaturas->nombre ?? 'N/A' ?></td>
                        </tr>
                        <tr>
                            <th>Generación</th>
                            <td><?= $alumno->generaciones->nombre ?? 'N/A' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 2: INFORMACIÓN PERSONAL -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingPersonal">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersonal">
                    🧍‍♂️ II. INFORMACIÓN PERSONAL
                </button>
            </h2>

            <div id="collapsePersonal" class="accordion-collapse collapse" aria-labelledby="headingPersonal">
                <div class="accordion-body">

                    <h5 class="text-primary">
                        <i class="fas fa-user"></i> Información Básica
                    </h5>

                    <table class="table table-bordered table-striped mb-4">
                        <tr>
                            <th>Nombre</th>
                            <td><?= $perfil->nombre ?></td>
                        </tr>
                        <tr>
                            <th>Apellido</th>
                            <td><?= $perfil->apellido ?></td>
                        </tr>
                        <tr>
                            <th>Fecha de nacimiento</th>
                            <td><?= Yii::$app->formatter->asDate($perfil->fecha_nacimiento, 'php:d/m/Y') ?></td>
                        </tr>
                        <tr>
                            <th>Usuario</th>
                            <td><?= $perfil->username ?></td>
                        </tr>
                        <tr>
                            <th>Género</th>
                            <td><?= $perfil->generoNombre ?></td>
                        </tr>
                    </table>

                    <h5 class="text-info">
                        <i class="fas fa-address-card"></i> Datos Adicionales
                    </h5>

                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>CURP</th>
                            <td><?= $datosPersonales->curp ?></td>
                        </tr>
                        <tr>
                            <th>RFC</th>
                            <td><?= $datosPersonales->rfc ?></td>
                        </tr>
                        <tr>
                            <th>NSS</th>
                            <td><?= $datosPersonales->nss ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 3: LUGAR DE NACIMIENTO -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingNacimiento">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNacimiento">
                    🎂 III. LUGAR DE NACIMIENTO
                </button>
            </h2>

            <div id="collapseNacimiento" class="accordion-collapse collapse" aria-labelledby="headingNacimiento">
                <div class="accordion-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Entidad Federativa</th>
                            <td><?= $lugaresNacimiento->entidadesFederativas->nombre ?? 'No especificado' ?></td>
                        </tr>
                        <tr>
                            <th>Municipio</th>
                            <td><?= $lugaresNacimiento->municipios->nombre ?? 'No especificado' ?></td>
                        </tr>
                        <tr>
                            <th>Localidad</th>
                            <td><?= $lugaresNacimiento->localidad ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SECCIÓN 4: DOMICILIO ACTUAL -->
        <!-- ===================== -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDomicilio">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDomicilio">
                    🏠 IV. DOMICILIO ACTUAL
                </button>
            </h2>

            <div id="collapseDomicilio" class="accordion-collapse collapse" aria-labelledby="headingDomicilio">
                <div class="accordion-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Entidad Federativa</th>
                            <td><?= $domiciliosActuales->entidadesFederativas->nombre ?? 'No especificado' ?></td>
                        </tr>
                        <tr>
                            <th>Municipio</th>
                            <td><?= $domiciliosActuales->municipios->nombre ?? 'No especificado' ?></td>
                        </tr>
                        <tr>
                            <th>Localidad</th>
                            <td><?= $domiciliosActuales->localidad ?></td>
                        </tr>
                        <tr>
                            <th>Calle</th>
                            <td><?= $domiciliosActuales->calle ?></td>
                        </tr>
                        <tr>
                            <th>Número exterior</th>
                            <td><?= $domiciliosActuales->numero_exterior ?></td>
                        </tr>
                        <tr>
                            <th>Número interior</th>
                            <td><?= $domiciliosActuales->numero_interior ?></td>
                        </tr>
                        <tr>
                            <th>Colonia</th>
                            <td><?= $domiciliosActuales->colonia ?></td>
                        </tr>
                        <tr>
                            <th>Código postal</th>
                            <td><?= $domiciliosActuales->codigo_postal ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>