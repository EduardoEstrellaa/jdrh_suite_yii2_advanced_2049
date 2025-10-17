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

                <!-- ADMINISTRACIÓN DEL SISTEMA -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAdministrar" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdministrar">
                        <i class="ri-tools-line"></i><span data-key="t-administrar">Administración</span>
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
                                    <i class="ri-shield-user-line"></i> <span data-key="t-rol">Roles</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/tipo-usuario']); ?>">
                                    <i class="ri-file-lock-line"></i> <span data-key="t-tipo-usuario">Tipos de Usuarios</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/estado']); ?>">
                                    <i class="ri-toggle-line"></i> <span data-key="t-estado">Estados de Usuarios</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- CATÁLOGOS GENERALES -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCatalogos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCatalogos">
                        <i class="ri-database-2-line"></i> <span data-key="t-catalogos">Catálogos Generales</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCatalogos">
                        <ul class="nav nav-sm flex-column">
                            <!-- UBICACIÓN GEOGRÁFICA -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarUbicacion" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUbicacion">
                                    <i class="ri-map-pin-2-line"></i><span data-key="t-ubicacion">Ubicación Geográfica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarUbicacion">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/entidades-federativas']); ?>">
                                                <i class="ri-government-line"></i><span data-key="t-entidades-federativas">Entidades Federativas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/municipios']); ?>">
                                                <i class="ri-building-2-line"></i><span data-key="t-municipios">Municipios</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/localidades']); ?>">
                                                <i class="ri-map-pin-2-line"></i><span data-key="t-localidades">Localidades</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- DATOS PERSONALES BÁSICOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarDatosPersonales" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDatosPersonales">
                                    <i class="ri-user-settings-line"></i><span data-key="t-datos-personales">Datos Personales</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarDatosPersonales">
                                    <ul class="nav nav-sm flex-column">
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
                                            <a class="nav-link menu-link" href="<?= Url::to(['/lugares-nacimiento']); ?>">
                                                <i class="ri-map-pin-user-line"></i><span data-key="t-lugares-nacimiento">Lugares de Nacimiento</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ESTRUCTURA ACADÉMICA -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarEstructuraAcademica" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEstructuraAcademica">
                                    <i class="ri-graduation-cap-line"></i><span data-key="t-estructura-academica">Estructura Académica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEstructuraAcademica">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/licenciaturas']); ?>">
                                                <i class="ri-graduation-cap-line"></i><span data-key="t-licenciaturas">Licenciaturas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/plan-estudios']); ?>">
                                                <i class="ri-book-line"></i><span data-key="t-plan-estudios">Plan de Estudios</span>
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
                                            <a class="nav-link menu-link" href="<?= Url::to(['/plan-semestres']); ?>">
                                                <i class="ri-calendar-schedule-line"></i><span data-key="t-plan-semestres">Plan Semestres</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/unidades-estudio']); ?>">
                                                <i class="ri-community-line"></i><span data-key="t-unidades-estudio">Unidades de Estudio</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- GESTIÓN ESCOLAR -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarGestionEscolar" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarGestionEscolar">
                                    <i class="ri-calendar-line"></i><span data-key="t-gestion-escolar">Gestión Escolar</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarGestionEscolar">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/generaciones']); ?>">
                                                <i class="ri-calendar-line"></i><span data-key="t-generaciones">Generaciones</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/ciclos-escolares']); ?>">
                                                <i class="ri-loop-left-line"></i><span data-key="t-ciclos-escolares">Ciclos Escolares</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/tipos-inscripciones']); ?>">
                                                <i class="ri-file-list-line"></i><span data-key="t-tipos-inscripciones">Tipos de Inscripciones</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/grupos']); ?>">
                                                <i class="ri-group-line"></i><span data-key="t-grupos">Grupos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- SITUACIÓN ECONÓMICA -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarEconomica" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEconomica">
                                    <i class="ri-money-dollar-circle-line"></i><span data-key="t-situacion-economica">Situación Económica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEconomica">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/categorias-dependencias']); ?>">
                                                <i class="ri-list-check"></i><span data-key="t-categorias-dependencias">Categorías Dependencias</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/catalogo-dependencias-economicas']); ?>">
                                                <i class="ri-building-line"></i><span data-key="t-catalogo-dependencias">Catálogo Dependencias</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/tipos-becas']); ?>">
                                                <i class="ri-award-line"></i><span data-key="t-tipos-becas">Tipos de Becas</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- VIVIENDA Y TRANSPORTE -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarViviendaTransporte" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarViviendaTransporte">
                                    <i class="ri-home-8-line"></i><span data-key="t-vivienda-transporte">Vivienda y Transporte</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarViviendaTransporte">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/tipos-viviendas']); ?>">
                                                <i class="ri-home-gear-line"></i><span data-key="t-tipos-viviendas">Tipos de Viviendas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/catalogo-servicios-vivienda']); ?>">
                                                <i class="ri-tools-line"></i><span data-key="t-servicios-vivienda">Servicios de Vivienda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/catalogo-bienes-vivienda']); ?>">
                                                <i class="ri-coupon-line"></i><span data-key="t-catalogo-bienes">Bienes de Vivienda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/catalogo-transportes']); ?>">
                                                <i class="ri-bus-line"></i><span data-key="t-catalogo-transportes">Catálogo Transportes</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/tiempo-recorrido-transporte']); ?>">
                                                <i class="ri-time-line"></i><span data-key="t-tiempo-recorrido">Tiempo de Recorrido</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- GESTIÓN DE ALUMNOS -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarGestionAlumnos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarGestionAlumnos">
                        <i class="ri-user-line"></i> <span data-key="t-gestion-alumnos">Gestión de Alumnos</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarGestionAlumnos">
                        <ul class="nav nav-sm flex-column">
                            <!-- INFORMACIÓN BÁSICA ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarInfoAlumnos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInfoAlumnos">
                                    <i class="ri-profile-line"></i><span data-key="t-info-alumnos">Información Básica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarInfoAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alumnos']); ?>">
                                                <i class="ri-user-line"></i><span data-key="t-alumnos">Alumnos</span>
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
                                            <a class="nav-link menu-link" href="<?= Url::to(['/domicilios-actuales']); ?>">
                                                <i class="ri-home-8-line"></i><span data-key="t-domicilios-actuales">Domicilios Actuales</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- INSCRIPCIONES Y GRUPOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarInscripciones" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInscripciones">
                                    <i class="ri-file-edit-line"></i><span data-key="t-inscripciones">Inscripciones y Grupos</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarInscripciones">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-inscripciones']); ?>">
                                                <i class="ri-file-edit-line"></i><span data-key="t-alum-inscripciones">Inscripciones</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/asignaciones-alumnos-grupos']); ?>">
                                                <i class="ri-user-add-line"></i><span data-key="t-asignaciones-alumnos-grupos">Asignación a Grupos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- INFORMACIÓN FAMILIAR -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarFamiliaAlumnos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarFamiliaAlumnos">
                                    <i class="ri-home-heart-line"></i><span data-key="t-familia-alumnos">Información Familiar</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarFamiliaAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-datos-familiares']); ?>">
                                                <i class="ri-home-heart-line"></i><span data-key="t-alum-datos-familiares">Datos Familiares</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-info-hijos']); ?>">
                                                <i class="ri-user-smile-line"></i><span data-key="t-alum-info-hijos">Información de Hijos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/edades-hijos']); ?>">
                                                <i class="ri-calendar-line"></i><span data-key="t-edades-hijos">Edades de Hijos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- SITUACIÓN ECONÓMICA ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarEconomicaAlumnos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEconomicaAlumnos">
                                    <i class="ri-money-dollar-circle-line"></i><span data-key="t-economica-alumnos">Situación Económica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEconomicaAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-dependen-economica']); ?>">
                                                <i class="ri-user-shared-line"></i><span data-key="t-alum-dependen">Dependen del Alumno</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/dependientes']); ?>">
                                                <i class="ri-user-follow-line"></i><span data-key="t-dependientes">Dependientes del Alumno</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-depende-economicamente']); ?>">
                                                <i class="ri-user-received-line"></i><span data-key="t-alum-depende">Alumno Depende</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-trabajo']); ?>">
                                                <i class="ri-briefcase-line"></i><span data-key="t-alum-trabajo">Alumno Trabaja</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-becas']); ?>">
                                                <i class="ri-medal-line"></i><span data-key="t-alum-becas">Becas del Alumno</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- VIVIENDA Y TRANSPORTE ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarViviendaAlumnos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarViviendaAlumnos">
                                    <i class="ri-home-8-line"></i><span data-key="t-vivienda-alumnos">Vivienda y Transporte</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarViviendaAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-vivienda']); ?>">
                                                <i class="ri-home-line"></i><span data-key="t-alum-vivienda">Vivienda del Alumno</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/vivienda-servicios']); ?>">
                                                <i class="ri-contrast-drop-2-line"></i><span data-key="t-vivienda-servicios">Servicios de Vivienda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/vivienda-bienes']); ?>">
                                                <i class="ri-coupon-line"></i><span data-key="t-vivienda-bienes">Bienes de Vivienda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-transportes']); ?>">
                                                <i class="ri-roadster-line"></i><span data-key="t-alum-transportes">Transporte del Alumno</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- TUTORÍAS Y ASIGNACIONES -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTutorias" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTutorias">
                        <i class="ri-user-shared-line"></i> <span data-key="t-tutorias">Tutorías y Asignaciones</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTutorias">
                        <ul class="nav nav-sm flex-column">
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
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>