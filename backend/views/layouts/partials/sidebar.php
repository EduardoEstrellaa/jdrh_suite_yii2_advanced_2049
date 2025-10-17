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

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDictamen" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDictamen">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-dictamen">Dictamenes</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDictamen">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/sede']); ?>">
                                    <i class="ri-building-line"></i><span data-key="t-sede">Sede</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/dictamen']); ?>">
                                    <i class="ri-user-line"></i><span data-key="t-dictamen">Dictamen</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/validacion']); ?>">
                                    <i class="ri-award-line"></i><span data-key="t-validacion">Validacion</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTransacciones" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTransacciones">
                        <i class="las la-briefcase"></i> <span data-key="t-Transacciones">Transacciones</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTransacciones">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?= Url::to(['/asignatura']); ?>">
                                    <i class="ri-building-2-line"></i><span data-key="t-asignatura">Venta</span>
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