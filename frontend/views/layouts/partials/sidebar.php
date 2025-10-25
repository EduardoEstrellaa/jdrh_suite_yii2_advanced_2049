<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Url;
use common\models\PermisosHelpers;

function tieneAcceso($opcion, $userId = null) {
    $rolesNecesarios = [
        'administrar' => ['Admin','SuperUsuario','Subdirector'],
        'ajuste' => ['Admin','SuperUsuario','Subdirector'],
        'admin-super' => ['Admin','SuperUsuario'],
        'proyectos' => ['Admin','SuperUsuario','Subdirector','Coordinador'],

        
    ];

    foreach ($rolesNecesarios[$opcion] as $rolNecesario) {
        if (PermisosHelpers::requerirRolEspecifico($rolNecesario, $userId)) {
            return true;
        }
    }

    return false;
}

?>

<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="administrador/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="administrador/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="administrador/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="administrador/images/logo-light.png" alt="" height="17">
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
                      
                        <?php if (tieneAcceso('administrar')): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAdministrar" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdministrar">
                            <i class="ri-tools-line"></i><span data-key="t-administrar">Administrar</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAdministrar">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (tieneAcceso('ajuste')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/ajuste']); ?>">
                                            <i class="ri-settings-3-line"></i> <span data-key="t-ajuste">Ajuste</span>
                                        </a>
                                    </li>

                                    <?php endif; ?>
                                    <?php if (tieneAcceso('admin-super')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/user']); ?>">
                                            <i class="ri-group-line"></i> <span data-key="t-user">Usuarios</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (tieneAcceso('admin-super')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/rol']); ?>">
                                        <i class="ri-shield-user-line"></i> <span data-key="t-rol">Rol</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (tieneAcceso('admin-super')): ?>           
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/permiso']);?>">
                                        <i class="ri-file-lock-line"></i> <span data-key="t-permiso">Permisos</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (tieneAcceso('admin-super')): ?>       
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/usuario-rol']);?>">
                                        <i class="ri-task-line"></i><span data-key="t-usuario-rol">Asignar Roles</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (tieneAcceso('admin-super')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/usuario-permiso']); ?>">
                                        <i class="ri-survey-line"></i><span data-key="t-usuario-permiso">Asignar Permisos</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (tieneAcceso('admin-super')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/estado']); ?>">
                                        <i class="ri-toggle-line"></i> <span data-key="t-estado">Estado</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                        <?php endif;?>
                        <?php if (tieneAcceso('proyectos')): ?>               
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= Url::to(['/proyecto']); ?>">
                                <i class="ri-file-list-3-line"></i> <span data-key="t-proyecto">Proyectos</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if (tieneAcceso('proyectos')): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarInstitution" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInstitution">
                                <i class="las la-graduation-cap"></i> <span data-key="t-institution">Institucion</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarInstitution">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/departamento']);?>"> 
                                        <i class="ri-building-line"></i><span data-key="t-departamento">Departamentos</span>
                                        </a>
                                    </li>
    
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/asesor-interno']);?>"> 
                                        <i class="ri-user-line"></i><span data-key="t-asesor-interno">Docente</span>
                                        </a>
                                    </li>
                                    <?php if (tieneAcceso('proyectos')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/grado-academico']);?>"> 
                                        <i class="ri-award-line"></i><span data-key="t-asesor-interno">Grados Academicos</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    
                                </ul>
                            </div>
                        </li>
                        <?php endif;?>
                        <?php if (tieneAcceso('proyectos')): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarEmpresa" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEmpresa">
                                <i class="las la-briefcase"></i> <span data-key="t-Empresa">Empresa</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarEmpresa">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/empresa']); ?>">
                                        <i class="ri-building-2-line"></i><span data-key="t-Empresas">Empresas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/asesor-externo']); ?>">
                                        <i class="ri-user-line"></i><span data-key="t-asesor-externo">Asesor Externo</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <?php endif;?>
                        <?php if (tieneAcceso('proyectos')): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarIngenieria" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIngenieria">
                                <i class="ri-honour-line"></i> <span data-key="t-forms">Ingenieria</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarIngenieria">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/especialidad']); ?>">
                                        <i class="ri-cpu-line"></i><span data-key="t-espacialidad">Especialidad</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="forms-select" class="nav-link" data-key="t-form-select">Plan de estudio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/asignatura']); ?>">
                                        <i class="ri-draft-line"></i><span data-key="t-asignatura">Asignatura</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif;?>
                        <?php if (tieneAcceso('proyectos')): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAlumnos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAlumnos">
                                <i class="las la-user-graduate"></i> <span data-key="t-tables">Alumnos</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAlumnos">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/preregistro']); ?>">
                                        <i class="ri-user-follow-line"></i><span data-key="t-preregistro">Pre-registros</span>
                                        </a>
                                    </li>
                                    <?php if (tieneAcceso('admin-super')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/documento']); ?>">
                                        <i class="ri-file-text-line"></i><span data-key="t-documento">Documentos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?= Url::to(['/expediente']); ?>">
                                        <i class="ri-folder-user-line"></i><span data-key="t-expediente">Expedientes</span>
                                        </a>
                                    </li>
                                    <?php endif;?>
                                </ul>
                            </div>
                        </li>
                        <?php endif;?>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>