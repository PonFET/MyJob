<div class='container-fluid'>
    <nav>
        <a href="<?= FRONT_ROOT ?>StatusController/typeSession">
        <i class="fas fa-video"> MyJob</i>
        </a>
            <div class="nav-header">
                <button class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                    <?php 
                    if(isset($_SESSION['account'])){
                        if($_SESSION['account']->getPrivilegios() == 0){?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= FROTN_ROOT ?>accountController/showList">Administrar Usuarios</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= FROTN_ROOT ?>companyController/adminList">Administrar Empresas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= FROTN_ROOT ?>jobOfferController/add">Agregar Propuesta Laboral</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= FROTN_ROOT ?>jobOfferController/showListAccepted">Ver Propuestas Laborales Aceptadas</a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Agregar Cuenta
                                </a>

                                <a class="dropdown-item" href="<?php echo FRONT_ROOT?>AccountController/addAdmin">Admin</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="<?= FRONT_ROOT ?>AccountController/addStudent">Estudiante</a>
                                
                            </li>

                        <?php } 
                        else {
                            ?>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?= FROTN_ROOT ?>jobOfferController/showList">Ver Propuestas Laborales</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= FROTN_ROOT ?>companyController/showList">Ver Empresas</a>
                            </li>

                            <!-- Muestra las postulaciones que ha hecho-->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= FROTN_ROOT ?>jobOfferController/showListHistory">Ver Historial de Propuestas Laborales</a>
                            </li>
                   
                        <?php } ?>
            </ul>
            <?php
            } if (!isset($_SESSION['account'])){ ?>

                <div class="userOff d-flex align-items-end">
                    <a class="nav-link" href="<?= FRONT_ROOT ?>LoginController/init">Iniciar Sesion</a>
                    <a class="nav-link" href="<?= FRONT_ROOT ?>AccountController/register">Crear Cuenta</a>
                </div>
            <?php 
            }else if ($_SESSION['account']->getPrivilegios() == 1) { ?>
                <?php $student = $_SESSION['account']->getStudent();   ?>
            
                <div class="userOff d-flex align-items-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= FRONT_ROOT ?>LoginController/init" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?= $student->getFirstName() . " " . $student->getLastName() ?>
                        </a>
            
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="<?= FRONT_ROOT ?>AccountController/viewAccount">Perfil</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?= FRONT_ROOT ?>AccountController/logOff">Cerrar Sesion</a>
                        </div>
                    </li>
                </div>
            
                <?php } else { ?>
            
                    <?php if ($_SESSION['account']->getPrivilegios() == 0) { ?>
            
                      <div class="userOff d-flex align-items-end">
                        <a class="nav-link" href="<?= FRONT_ROOT ?>AccountController/logOff">Cerrar Sesion</a>
                      </div>
            
                    <?php }
                    }
                ?>
        </div>
    </nav>
</div>
