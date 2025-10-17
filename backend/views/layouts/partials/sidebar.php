<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Url;
use common\models\PermisosHelpers;

?>

<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="theme/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="theme/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="theme/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="theme/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?= Url::to(['/site']); ?>">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-site">Panel de control</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAdministrar" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdministrar">
                        <i class="ri-tools-line"></i><span data-key="t-administrar">Administracion</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAdministrar">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/user']); ?>">
                                    <i class="ri-group-line"></i> <span data-key="t-user">Usuarios</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/rol']); ?>">
                                    <i class="ri-shield-user-line"></i> <span data-key="t-rol">Rol</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/tipo-usuario']); ?>">
                                    <i class="ri-file-lock-line"></i> <span data-key="t-tipo-usuario">Tipos de Usuarios</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/estado']); ?>">
                                    <i class="ri-toggle-line"></i> <span data-key="t-estado">Estado de Usuarios</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- NUEVO MÓDULO DATOS GENERALES -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDatosGenerales" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDatosGenerales">
                        <i class="ri-database-2-line"></i> <span data-key="t-datos-generales">Datos Generales</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDatosGenerales">
                        <ul class="nav nav-sm flex-column">
                            <!-- EDUARDO ALEXANDER ESTRELLA ESCOBEDO -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/generaciones']); ?>">
                                    <i class="ri-calendar-line"></i><span data-key="t-generaciones">Generaciones</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/plan-estudios']); ?>">
                                    <i class="ri-book-line"></i><span data-key="t-plan-estudios">Plan de Estudios</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/licenciaturas']); ?>">
                                    <i class="ri-graduation-cap-line"></i><span data-key="t-licenciaturas">Licenciaturas</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/plan-licenciaturas']); ?>">
                                    <i class="ri-map-pin-line"></i><span data-key="t-plan-licenciaturas">Plan de Licenciaturas</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/semestres']); ?>">
                                    <i class="ri-time-line"></i><span data-key="t-semestres">Semestres</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/unidades-estudio']); ?>">
                                    <i class="ri-community-line"></i><span data-key="t-unidades-estudio">Unidades de Estudio</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/plan-semestres']); ?>">
                                    <i class="ri-calendar-schedule-line"></i><span data-key="t-plan-semestres">Plan Semestres</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/ciclos-escolares']); ?>">
                                    <i class="ri-loop-left-line"></i><span data-key="t-ciclos-escolares">Ciclos Escolares</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/grupos']); ?>">
                                    <i class="ri-group-line"></i><span data-key="t-grupos">Grupos</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/tipos-inscripciones']); ?>">
                                    <i class="ri-file-list-line"></i><span data-key="t-tipos-inscripciones">Tipos de Inscripciones</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/asignaciones-tutores']); ?>">
                                    <i class="ri-user-shared-line"></i><span data-key="t-asignaciones-tutores">Asignaciones de Tutores</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/asignaciones-grupos']); ?>">
                                    <i class="ri-layout-grid-line"></i><span data-key="t-asignaciones-grupos">Asignaciones de Grupos</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/alumnos']); ?>">
                                    <i class="ri-user-line"></i><span data-key="t-alumnos">Alumnos</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/alum-inscripciones']); ?>">
                                    <i class="ri-file-edit-line"></i><span data-key="t-alum-inscripciones">Alumnos Inscripciones</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/alum-datos-familiares']); ?>">
                                    <i class="ri-home-heart-line"></i><span data-key="t-alum-datos-familiares">Alumnos Datos Familiares</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/asignaciones-alumnos-grupos']); ?>">
                                    <i class="ri-user-add-line"></i><span data-key="t-asignaciones-alumnos-grupos">Asignaciones Alumnos a Grupos</span>
                                </a>
                            </li>

                            <!-- JOHANA YANET OLIVO ESCOBEDO -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/estados-civiles']); ?>">
                                    <i class="ri-heart-line"></i><span data-key="t-estados-civiles">Estados Civiles</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/nacionalidades']); ?>">
                                    <i class="ri-flag-line"></i><span data-key="t-nacionalidades">Nacionalidades</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/datos-generales']); ?>">
                                    <i class="ri-profile-line"></i><span data-key="t-datos-generales-item">Datos Generales</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/datos-personales']); ?>">
                                    <i class="ri-user-settings-line"></i><span data-key="t-datos-personales">Datos Personales</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/localidades']); ?>">
                                    <i class="ri-map-pin-2-line"></i><span data-key="t-localidades">Localidades</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/municipios']); ?>">
                                    <i class="ri-building-2-line"></i><span data-key="t-municipios">Municipios</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/entidades-federativas']); ?>">
                                    <i class="ri-government-line"></i><span data-key="t-entidades-federativas">Entidades Federativas</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/domicilios-actuales']); ?>">
                                    <i class="ri-home-8-line"></i><span data-key="t-domicilios-actuales">Domicilios Actuales</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/lugares-nacimiento']); ?>">
                                    <i class="ri-map-pin-user-line"></i><span data-key="t-lugares-nacimiento">Lugares Nacimiento</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>