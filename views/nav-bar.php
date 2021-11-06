<div class='container-fluid'>
    <nav>        
        <!-- modificar este front -->        
        
        </a>
            <div class="nav-header">
                <button class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto ">
                    <?php 
                    if(isset($_SESSION['account'])){
                        if($_SESSION['account']->getPrivilegios() == "admin"){?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= FRONT_ROOT ?>account/showList">Administrar Usuarios</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= FRONT_ROOT ?>company/adminList">Administrar Empresas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= FRONT_ROOT ?>jobOffer/add">Agregar Propuesta Laboral</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= FRONT_ROOT ?>jobOffer/showListAccepted">Ver Propuesta Laboral Aceptadas</a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Agregar Cuenta
                                </a>

                        <!-- Agregar Usuario, Preguntar a que se refiere. || Estudiantes o cuentas Admin (cuentas de empresa opcional pero preferible)-->
                                <a class="dropdown-item" href="<?php echo FRONT_ROOT?>Account/addAdmin">Admin</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="<?= FRONT_ROOT ?>Account/addStudent">Estudiante</a>
                                
                            </li>

                        <?php } 
                        else {
                            ?>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?= FRONT_ROOT ?>company/showList">Ver Empresas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= FRONT_ROOT ?>jobOffer/showOfferView">Ver Propuesta Laboral</a>
                            </li>

                            <!-- Muestra las postulaciones que ha hecho-->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= FRONT_ROOT ?>jobOffer/showListHistory">Ver Historial de Propuestas Laborales de Estudiantes</a>
                            </li>
                   
                        <?php } ?>
            </ul>
            <?php
            } if (!isset($_SESSION['account'])){ ?>

                <div class="userOff d-flex align-items-end">
                    <a class="nav-link" href="<?= FRONT_ROOT ?>Login/init">Iniciar Sesion</a>
                    <a class="nav-link" href="<?= FRONT_ROOT ?>Account/register">Crear Cuenta</a>
                </div>
            <?php 
            }else if ($_SESSION['account']->getPrivilegios() == "student") { ?>
                <?php $student = $_SESSION['account']->getStudent();   ?>
            
                <div class="userOff d-flex align-items-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= FRONT_ROOT ?>Login/init" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?= $student->getFirstName() . " " . $student->getLastName() ?>
                        </a>
            
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="<?= FRONT_ROOT ?>Account/viewAccount">Perfil</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?= FRONT_ROOT ?>Account/logOff">Cerrar Sesion</a>
                        </div>
                    </li>
                </div>
            
                <?php } else { ?>
            
                    <?php if ($_SESSION['account']->getPrivilegios() == "admin") { ?>
            
                      <div class="userOff d-flex align-items-end">
                        <a class="nav-link" href="<?= FRONT_ROOT ?>Account/logOff">Cerrar Sesion</a>
                      </div>
            
                    <?php }
                    }
                ?>
        </div>
    </nav>
</div>
