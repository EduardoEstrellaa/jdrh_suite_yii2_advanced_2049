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
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
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
                    <a class="nav-link menu-link" href="#sidebarAdministrar" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarAdministrar">
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
                                    <i class="ri-file-lock-line"></i> <span data-key="t-tipo-usuario">Tipos de
                                        Usuarios</span>
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
                    <a class="nav-link menu-link" href="#sidebarCatalogos" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCatalogos">
                        <i class="ri-database-2-line"></i> <span data-key="t-catalogos">Catálogos Generales</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCatalogos">
                        <ul class="nav nav-sm flex-column">
                            <!-- UBICACIÓN GEOGRÁFICA -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarUbicacion" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarUbicacion">
                                    <i class="ri-map-pin-2-line"></i><span data-key="t-ubicacion">Ubicación
                                        Geográfica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarUbicacion">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/entidades-federativas']); ?>">
                                                <i class="ri-government-line"></i><span
                                                    data-key="t-entidades-federativas">Entidades Federativas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/municipios']); ?>">
                                                <i class="ri-building-2-line"></i><span
                                                    data-key="t-municipios">Municipios</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/localidades']); ?>">
                                                <i class="ri-map-pin-2-line"></i><span
                                                    data-key="t-localidades">Localidades</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- DATOS PERSONALES BÁSICOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarDatosPersonales" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarDatosPersonales">
                                    <i class="ri-user-settings-line"></i><span data-key="t-datos-personales">Datos
                                        Personales</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarDatosPersonales">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/estados-civiles']); ?>">
                                                <i class="ri-heart-line"></i><span data-key="t-estados-civiles">Estados
                                                    Civiles</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/nacionalidades']); ?>">
                                                <i class="ri-flag-line"></i><span
                                                    data-key="t-nacionalidades">Nacionalidades</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/lugares-nacimiento']); ?>">
                                                <i class="ri-map-pin-user-line"></i><span
                                                    data-key="t-lugares-nacimiento">Lugares de Nacimiento</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ESTRUCTURA ACADÉMICA -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarEstructuraAcademica"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarEstructuraAcademica">
                                    <i class="ri-graduation-cap-line"></i><span
                                        data-key="t-estructura-academica">Estructura Académica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEstructuraAcademica">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/licenciaturas']); ?>">
                                                <i class="ri-graduation-cap-line"></i><span
                                                    data-key="t-licenciaturas">Licenciaturas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/plan-estudios']); ?>">
                                                <i class="ri-book-line"></i><span data-key="t-plan-estudios">Plan de
                                                    Estudios</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/plan-licenciaturas']); ?>">
                                                <i class="ri-map-pin-line"></i><span
                                                    data-key="t-plan-licenciaturas">Plan de Licenciaturas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/semestres']); ?>">
                                                <i class="ri-time-line"></i><span
                                                    data-key="t-semestres">Semestres</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/plan-semestres']); ?>">
                                                <i class="ri-calendar-schedule-line"></i><span
                                                    data-key="t-plan-semestres">Plan Semestres</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/unidades-estudio']); ?>">
                                                <i class="ri-community-line"></i><span
                                                    data-key="t-unidades-estudio">Unidades de Estudio</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- GESTIÓN ESCOLAR -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarGestionEscolar" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarGestionEscolar">
                                    <i class="ri-calendar-line"></i><span data-key="t-gestion-escolar">Gestión
                                        Escolar</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarGestionEscolar">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/generaciones']); ?>">
                                                <i class="ri-calendar-line"></i><span
                                                    data-key="t-generaciones">Generaciones</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/ciclos-escolares']); ?>">
                                                <i class="ri-loop-left-line"></i><span
                                                    data-key="t-ciclos-escolares">Ciclos Escolares</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/tipos-inscripciones']); ?>">
                                                <i class="ri-file-list-line"></i><span
                                                    data-key="t-tipos-inscripciones">Tipos de Inscripciones</span>
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
                                <a class="nav-link menu-link" href="#sidebarEconomica" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarEconomica">
                                    <i class="ri-money-dollar-circle-line"></i><span
                                        data-key="t-situacion-economica">Situación Económica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEconomica">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/categorias-dependencias']); ?>">
                                                <i class="ri-list-check"></i><span
                                                    data-key="t-categorias-dependencias">Categorías Dependencias</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-dependencias-economicas']); ?>">
                                                <i class="ri-building-line"></i><span
                                                    data-key="t-catalogo-dependencias">Catálogo Dependencias</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/tipos-becas']); ?>">
                                                <i class="ri-award-line"></i><span data-key="t-tipos-becas">Tipos de
                                                    Becas</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- VIVIENDA Y TRANSPORTE -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarViviendaTransporte"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarViviendaTransporte">
                                    <i class="ri-home-8-line"></i><span data-key="t-vivienda-transporte">Vivienda y
                                        Transporte</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarViviendaTransporte">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/tipos-viviendas']); ?>">
                                                <i class="ri-home-gear-line"></i><span
                                                    data-key="t-tipos-viviendas">Tipos de Viviendas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-servicios-vivienda']); ?>">
                                                <i class="ri-tools-line"></i><span
                                                    data-key="t-servicios-vivienda">Servicios de Vivienda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-bienes-vivienda']); ?>">
                                                <i class="ri-coupon-line"></i><span data-key="t-catalogo-bienes">Bienes
                                                    de Vivienda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-transportes']); ?>">
                                                <i class="ri-bus-line"></i><span
                                                    data-key="t-catalogo-transportes">Catálogo Transportes</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/tiempo-recorrido-transporte']); ?>">
                                                <i class="ri-time-line"></i><span data-key="t-tiempo-recorrido">Tiempo
                                                    de Recorrido</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- HÁBITOS Y ESTILO DE VIDA -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarHabitos" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarHabitos">
                                    <i class="ri-heart-pulse-line"></i><span data-key="t-habitos">Hábitos y Estilo de
                                        Vida</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarHabitos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-cigarros-dia']); ?>">
                                                <i class="ri-smoking-line"></i><span
                                                    data-key="t-catalogo-cigarros-dia">Cigarros al Día</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-usos-internet']); ?>">
                                                <i class="ri-wifi-line"></i><span
                                                    data-key="t-catalogo-usos-internet">Usos de Internet</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-lugares-acceso-principal']); ?>">
                                                <i class="ri-map-pin-line"></i><span
                                                    data-key="t-catalogo-lugares-acceso-principal">Lugares de
                                                    Acceso</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ORGANIZACIONES Y PARTICIPACIÓN -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarOrganizaciones" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarOrganizaciones">
                                    <i class="ri-organization-chart"></i><span
                                        data-key="t-organizaciones">Organizaciones</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarOrganizaciones">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/tipo-organizacion']); ?>">
                                                <i class="ri-list-check"></i><span data-key="t-tipo-organizacion">Tipos
                                                    de Organización</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-organizaciones']); ?>">
                                                <i class="ri-building-line"></i><span
                                                    data-key="t-catalogo-organizaciones">Catálogo de
                                                    Organizaciones</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/organizaciones']); ?>">
                                                <i class="ri-community-line"></i><span
                                                    data-key="t-organizaciones">Organizaciones</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- SALUD Y BIENESTAR -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarSalud" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarSalud">
                                    <i class="ri-heart-line"></i><span data-key="t-salud">Salud y Bienestar</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSalud">
                                    <ul class="nav nav-sm flex-column">
                                        <!-- PROBLEMAS DE SALUD -->
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="#sidebarProblemasSalud"
                                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                                aria-controls="sidebarProblemasSalud">
                                                <i class="ri-hospital-line"></i><span
                                                    data-key="t-problemas-salud">Problemas de Salud</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarProblemasSalud">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/catalogo-problemas-salud']); ?>">
                                                            <i class="ri-list-check"></i><span
                                                                data-key="t-catalogo-problemas-salud">Catálogo
                                                                Problemas</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/tipo-gravedad']); ?>">
                                                            <i class="ri-alert-line"></i><span
                                                                data-key="t-tipo-gravedad">Tipos de Gravedad</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/problemas-salud']); ?>">
                                                            <i class="ri-stethoscope-line"></i><span
                                                                data-key="t-problemas-salud">Problemas de Salud</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- SERVICIOS DE SALUD -->
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="#sidebarServiciosSalud"
                                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                                aria-controls="sidebarServiciosSalud">
                                                <i class="ri-first-aid-kit-line"></i><span
                                                    data-key="t-servicios-salud">Servicios de Salud</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarServiciosSalud">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/catalogo-servicios-salud']); ?>">
                                                            <i class="ri-list-check"></i><span
                                                                data-key="t-catalogo-servicios-salud">Catálogo
                                                                Servicios</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/servicios-salud']); ?>">
                                                            <i class="ri-hospital-line"></i><span
                                                                data-key="t-servicios-salud">Servicios de Salud</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- TRATAMIENTOS MÉDICOS -->
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="#sidebarTratamientos"
                                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                                aria-controls="sidebarTratamientos">
                                                <i class="ri-capsule-line"></i><span
                                                    data-key="t-tratamientos">Tratamientos</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarTratamientos">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/tipos-tratamientos']); ?>">
                                                            <i class="ri-list-check"></i><span
                                                                data-key="t-tipos-tratamientos">Tipos de
                                                                Tratamientos</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/catalogo-tratamientos']); ?>">
                                                            <i class="ri-medicine-bottle-line"></i><span
                                                                data-key="t-catalogo-tratamientos">Catálogo
                                                                Tratamientos</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/tratamientos']); ?>">
                                                            <i class="ri-capsule-line"></i><span
                                                                data-key="t-tratamientos">Tratamientos</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- ALERGIAS -->
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="#sidebarAlergias"
                                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                                aria-controls="sidebarAlergias">
                                                <i class="ri-allergy-line"></i><span
                                                    data-key="t-alergias">Alergias</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarAlergias">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/tipo-alergias']); ?>">
                                                            <i class="ri-list-check"></i><span
                                                                data-key="t-tipo-alergias">Tipos de Alergias</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/catalogo-alergias']); ?>">
                                                            <i class="ri-skull-line"></i><span
                                                                data-key="t-catalogo-alergias">Catálogo Alergias</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/alergias']); ?>">
                                                            <i class="ri-allergy-line"></i><span
                                                                data-key="t-alergias">Alergias</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/catalogo-reacciones-alergicas']); ?>">
                                                            <i class="ri-flask-line"></i><span
                                                                data-key="t-catalogo-reacciones-alergicas">Reacciones
                                                                Alérgicas</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/varias-reacciones-alergicas']); ?>">
                                                            <i class="ri-bug-line"></i><span
                                                                data-key="t-varias-reacciones-alergicas">Varias
                                                                Reacciones</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- ENFERMEDADES CRÓNICAS -->
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="#sidebarEnfermedadesCronicas"
                                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                                aria-controls="sidebarEnfermedadesCronicas">
                                                <i class="ri-heart-pulse-line"></i><span
                                                    data-key="t-enfermedades-cronicas">Enfermedades Crónicas</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarEnfermedadesCronicas">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/catalogo-enferm-cronicas']); ?>">
                                                            <i class="ri-list-check"></i><span
                                                                data-key="t-catalogo-enferm-cronicas">Catálogo
                                                                Enfermedades</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/enfermedades-cronicas']); ?>">
                                                            <i class="ri-heart-pulse-line"></i><span
                                                                data-key="t-enfermedades-cronicas">Enfermedades
                                                                Crónicas</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- FRECUENCIAS -->
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="#sidebarFrecuencias"
                                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                                aria-controls="sidebarFrecuencias">
                                                <i class="ri-time-line"></i><span
                                                    data-key="t-frecuencias">Frecuencias</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarFrecuencias">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/frecuencia-tiempo']); ?>">
                                                            <i class="ri-time-line"></i><span
                                                                data-key="t-frecuencia-tiempo">Frecuencia de
                                                                Tiempo</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/frecuencia-veces']); ?>">
                                                            <i class="ri-repeat-line"></i><span
                                                                data-key="t-frecuencia-veces">Frecuencia Veces</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/frecuencia-veces-semana']); ?>">
                                                            <i class="ri-calendar-line"></i><span
                                                                data-key="t-frecuencia-veces-semana">Frecuencia por
                                                                Semana</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- VISIÓN -->
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="#sidebarVision"
                                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                                aria-controls="sidebarVision">
                                                <i class="ri-eye-line"></i><span data-key="t-vision">Visión</span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarVision">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/catalogo-uso-anteojos']); ?>">
                                                            <i class="ri-list-check"></i><span
                                                                data-key="t-catalogo-uso-anteojos">Catálogo Uso
                                                                Anteojos</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link"
                                                            href="<?= Url::to(['/uso-anteojos']); ?>">
                                                            <i class="ri-glasses-line"></i><span
                                                                data-key="t-uso-anteojos">Uso de Anteojos</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- NUTRICIÓN Y ALIMENTACIÓN -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarNutricion" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarNutricion">
                                    <i class="ri-restaurant-line"></i><span data-key="t-nutricion">Nutrición y
                                        Alimentación</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarNutricion">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/categorias-catalogo-alimentos']); ?>">
                                                <i class="ri-list-check"></i><span
                                                    data-key="t-categorias-catalogo-alimentos">Categorías de
                                                    Alimentos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-alimentos']); ?>">
                                                <i class="ri-apple-line"></i><span
                                                    data-key="t-catalogo-alimentos">Catálogo de Alimentos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-lugares-comer']); ?>">
                                                <i class="ri-map-pin-line"></i><span
                                                    data-key="t-catalogo-lugares-comer">Lugares para Comer</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ACTIVIDAD FÍSICA Y DEPORTE -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarActividadFisica" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarActividadFisica">
                                    <i class="ri-run-line"></i><span data-key="t-actividad-fisica">Actividad
                                        Física</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarActividadFisica">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-deportes']); ?>">
                                                <i class="ri-list-check"></i><span
                                                    data-key="t-catalogo-deportes">Catálogo de Deportes</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/deportes']); ?>">
                                                <i class="ri-basketball-line"></i><span
                                                    data-key="t-deportes">Deportes</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-actividad-ejercicio']); ?>">
                                                <i class="ri-list-check"></i><span
                                                    data-key="t-catalogo-actividad-ejercicio">Actividades de
                                                    Ejercicio</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/ejercicio-fisico']); ?>">
                                                <i class="ri-run-line"></i><span data-key="t-ejercicio-fisico">Ejercicio
                                                    Físico</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- BIENES PERSONALES -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarBienesPersonales" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarBienesPersonales">
                                    <i class="ri-archive-drawer-line"></i><span data-key="t-bienes-personales">Bienes
                                        Personales</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarBienesPersonales">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/catalogo-bienes-personales']); ?>">
                                                <i class="ri-list-check"></i><span
                                                    data-key="t-catalogo-bienes-personales">Catálogo Bienes
                                                    Personales</span>
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
                    <a class="nav-link menu-link" href="#sidebarGestionAlumnos" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarGestionAlumnos">
                        <i class="ri-user-line"></i> <span data-key="t-gestion-alumnos">Gestión de Alumnos</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarGestionAlumnos">
                        <ul class="nav nav-sm flex-column">
                            <!-- INFORMACIÓN BÁSICA ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarInfoAlumnos" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarInfoAlumnos">
                                    <i class="ri-profile-line"></i><span data-key="t-info-alumnos">Información
                                        Básica</span>
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
                                                <i class="ri-profile-line"></i><span
                                                    data-key="t-datos-generales-item">Datos Generales</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/datos-personales']); ?>">
                                                <i class="ri-user-settings-line"></i><span
                                                    data-key="t-datos-personales">Datos Personales</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/domicilios-actuales']); ?>">
                                                <i class="ri-home-8-line"></i><span
                                                    data-key="t-domicilios-actuales">Domicilios Actuales</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- INSCRIPCIONES Y GRUPOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarInscripciones" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarInscripciones">
                                    <i class="ri-file-edit-line"></i><span data-key="t-inscripciones">Inscripciones y
                                        Grupos</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarInscripciones">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-inscripciones']); ?>">
                                                <i class="ri-file-edit-line"></i><span
                                                    data-key="t-alum-inscripciones">Inscripciones</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/asignaciones-alumnos-grupos']); ?>">
                                                <i class="ri-user-add-line"></i><span
                                                    data-key="t-asignaciones-alumnos-grupos">Asignación a Grupos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- INFORMACIÓN FAMILIAR -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarFamiliaAlumnos" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarFamiliaAlumnos">
                                    <i class="ri-home-heart-line"></i><span data-key="t-familia-alumnos">Información
                                        Familiar</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarFamiliaAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-datos-familiares']); ?>">
                                                <i class="ri-home-heart-line"></i><span
                                                    data-key="t-alum-datos-familiares">Datos Familiares</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-info-hijos']); ?>">
                                                <i class="ri-user-smile-line"></i><span
                                                    data-key="t-alum-info-hijos">Información de Hijos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/edades-hijos']); ?>">
                                                <i class="ri-calendar-line"></i><span data-key="t-edades-hijos">Edades
                                                    de Hijos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- SITUACIÓN ECONÓMICA ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarEconomicaAlumnos" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarEconomicaAlumnos">
                                    <i class="ri-money-dollar-circle-line"></i><span
                                        data-key="t-economica-alumnos">Situación Económica</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEconomicaAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-dependen-economica']); ?>">
                                                <i class="ri-user-shared-line"></i><span
                                                    data-key="t-alum-dependen">Dependen del Alumno</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/dependientes']); ?>">
                                                <i class="ri-user-follow-line"></i><span
                                                    data-key="t-dependientes">Dependientes del Alumno</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-depende-economicamente']); ?>">
                                                <i class="ri-user-received-line"></i><span
                                                    data-key="t-alum-depende">Alumno Depende</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-trabajo']); ?>">
                                                <i class="ri-briefcase-line"></i><span data-key="t-alum-trabajo">Alumno
                                                    Trabaja</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-becas']); ?>">
                                                <i class="ri-medal-line"></i><span data-key="t-alum-becas">Becas del
                                                    Alumno</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- VIVIENDA Y TRANSPORTE ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarViviendaAlumnos" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarViviendaAlumnos">
                                    <i class="ri-home-8-line"></i><span data-key="t-vivienda-alumnos">Vivienda y
                                        Transporte</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarViviendaAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-vivienda']); ?>">
                                                <i class="ri-home-line"></i><span data-key="t-alum-vivienda">Vivienda
                                                    del Alumno</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/vivienda-servicios']); ?>">
                                                <i class="ri-contrast-drop-2-line"></i><span
                                                    data-key="t-vivienda-servicios">Servicios de Vivienda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/vivienda-bienes']); ?>">
                                                <i class="ri-coupon-line"></i><span data-key="t-vivienda-bienes">Bienes
                                                    de Vivienda</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-transportes']); ?>">
                                                <i class="ri-roadster-line"></i><span
                                                    data-key="t-alum-transportes">Transporte del Alumno</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- HÁBITOS Y ESTILO DE VIDA ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarHabitosAlumnos" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarHabitosAlumnos">
                                    <i class="ri-heart-pulse-line"></i><span data-key="t-habitos-alumnos">Hábitos y
                                        Estilo de Vida</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarHabitosAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-habitos-consumo']); ?>">
                                                <i class="ri-drinks-line"></i><span data-key="t-habitos-consumo">Hábitos
                                                    de Consumo</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-recreacion-tiempo']); ?>">
                                                <i class="ri-gamepad-line"></i><span
                                                    data-key="t-alum-recreacion-tiempo">Recreación y Tiempo Libre</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/usos-internet']); ?>">
                                                <i class="ri-wifi-line"></i><span data-key="t-usos-internet">Usos de
                                                    Internet</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ORGANIZACIONES ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarOrganizacionesAlumnos"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarOrganizacionesAlumnos">
                                    <i class="ri-organization-chart"></i><span
                                        data-key="t-organizaciones-alumnos">Participación en Organizaciones</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarOrganizacionesAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-organizacion']); ?>">
                                                <i class="ri-user-shared-line"></i><span
                                                    data-key="t-alum-organizacion">Organizaciones del Alumno</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- SALUD ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarSaludAlumnos" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarSaludAlumnos">
                                    <i class="ri-heart-line"></i><span data-key="t-salud-alumnos">Salud del
                                        Alumno</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSaludAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-estado-salud']); ?>">
                                                <i class="ri-user-health-line"></i><span
                                                    data-key="t-alum-estado-salud">Estado de Salud</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-servicios-salud']); ?>">
                                                <i class="ri-hospital-line"></i><span
                                                    data-key="t-alum-servicios-salud">Servicios de Salud</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-asiste-medico']); ?>">
                                                <i class="ri-stethoscope-line"></i><span
                                                    data-key="t-alum-asiste-medico">Visitas al Médico</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-asiste-dentista']); ?>">
                                                <i class="ri-tooth-line"></i><span
                                                    data-key="t-alum-asiste-dentista">Visitas al Dentista</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-uso-anteojos']); ?>">
                                                <i class="ri-glasses-line"></i><span data-key="t-alum-uso-anteojos">Uso
                                                    de Anteojos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-tratamientos']); ?>">
                                                <i class="ri-capsule-line"></i><span
                                                    data-key="t-alum-tratamientos">Tratamientos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-alergia']); ?>">
                                                <i class="ri-allergy-line"></i><span
                                                    data-key="t-alum-alergia">Alergias</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-enfermedades-cronicas']); ?>">
                                                <i class="ri-heart-pulse-line"></i><span
                                                    data-key="t-alum-enfermedades-cronicas">Enfermedades Crónicas</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- NUTRICIÓN ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarNutricionAlumnos" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarNutricionAlumnos">
                                    <i class="ri-restaurant-line"></i><span data-key="t-nutricion-alumnos">Nutrición y
                                        Alimentación</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarNutricionAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-lugares-comer']); ?>">
                                                <i class="ri-map-pin-line"></i><span
                                                    data-key="t-alum-lugares-comer">Lugares para Comer</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-consumo-alimentos']); ?>">
                                                <i class="ri-apple-line"></i><span
                                                    data-key="t-alum-consumo-alimentos">Consumo de Alimentos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ACTIVIDAD FÍSICA ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarActividadFisicaAlumnos"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarActividadFisicaAlumnos">
                                    <i class="ri-run-line"></i><span data-key="t-actividad-fisica-alumnos">Actividad
                                        Física</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarActividadFisicaAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-deportes']); ?>">
                                                <i class="ri-basketball-line"></i><span
                                                    data-key="t-alum-deportes">Deportes</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="<?= Url::to(['/alum-ejercicio']); ?>">
                                                <i class="ri-run-line"></i><span data-key="t-alum-ejercicio">Ejercicio
                                                    Físico</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- BIENES PERSONALES ALUMNOS -->
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarBienesPersonalesAlumnos"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarBienesPersonalesAlumnos">
                                    <i class="ri-archive-drawer-line"></i><span
                                        data-key="t-bienes-personales-alumnos">Bienes Personales</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarBienesPersonalesAlumnos">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link menu-link"
                                                href="<?= Url::to(['/alum-bienes-personales']); ?>">
                                                <i class="ri-archive-drawer-line"></i><span
                                                    data-key="t-alum-bienes-personales">Bienes Personales</span>
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
                    <a class="nav-link menu-link" href="#sidebarTutorias" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTutorias">
                        <i class="ri-user-shared-line"></i> <span data-key="t-tutorias">Tutorías y Asignaciones</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTutorias">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/asignaciones-tutores']); ?>">
                                    <i class="ri-user-shared-line"></i><span
                                        data-key="t-asignaciones-tutores">Asignaciones de Tutores</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/asignaciones-grupos']); ?>">
                                    <i class="ri-layout-grid-line"></i><span
                                        data-key="t-asignaciones-grupos">Asignaciones de Grupos</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <!-- INVENTARIO -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarInventario" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarInventario">
                        <i class="ri-archive-drawer-line"></i><span data-key="t-Inventario">Modulo Inventario</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarInventario">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/equipos']); ?>">
                                    <i class="ri-list-check"></i><span data-key="t-equipos">Equipos</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/estado-equipo']); ?>">
                                    <i class="ri-list-check"></i><span data-key="t-estado-equipo">Estado Equipos</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/estado-equipo']); ?>">
                                    <i class="ri-list-check"></i><span data-key="t-estado-equipo">Reportes por
                                        departamento</span>
                                </a>
                            </li>

                        </ul>
                    </div>
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