<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">    
    <span class="navbar-text">
            <strong>MyJob</strong>
    </span>

    <?php if(isset($_SESSION['account'])){
        if($_SESSION['account']->getPrivilegios() == "admin"){ ?>

            <!-- Admin -->
        
    <ul class="navbar-nav ml-auto">        
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/showList">Administrar Usuarios</a>
        </li> 

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>company/adminList">Administrar Empresas</a>
        </li>       

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/showAddOfferView">Agregar Propuesta Laboral</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/showListActive">Ver Propuestas Activas</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/logOff">Cerrar sesion</a>
        </li>
    </ul>
    <?php }
    else if($_SESSION['account']->getPrivilegios() == "student") { ?>

        <!-- Estudiante -->
    <span class="navbar-text">
        <strong><?php //echo $_SESSION['lastName'] ?></strong>
    </span>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/viewAccount">Mi Perfil</a>
        </li>     
    
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>company/showList">Ver Empresas</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/showOfferView">Ver Propuestas</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/studentPostulationHistory">Ver Historial de Postulaciones</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/logOff">Cerrar sesion</a>
        </li>
    </ul>
    <?php }
        else if($_SESSION['account']->getPrivilegios() == "company"){?>

            <!-- Compañia -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/viewCompany">Ver Perfil</a>
            </li>
    
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/showAddOfferView">Agregar Propuesta Laboral</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/showPostulations">Ver Postulaciones</a>
            </li>
    
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/logOff">Cerrar sesion</a>
            </li>
        </ul>
        <?php

        } } if (!isset($_SESSION['account'])) { ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/logIn">Iniciar Sesión</a>
            </li> 

            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/register">Registrarse</a>
            </li>                           
        </ul>

        <?php } ?>

</nav>