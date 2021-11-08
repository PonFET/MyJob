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
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/add">Agregar Propuesta Laboral</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/showListAccepted">Ver Propuestas Aceptadas</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/logOff">Cerrar sesion</a>
        </li>
    </ul>
    <?php }
    else { ?>

        <!-- Estudiante -->
    <span class="navbar-text">
        <strong><?php //echo $_SESSION['lastName'] ?></strong>
    </span>
    <ul class="navbar-nav ml-auto">        
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>company/showList">Ver Empresas</a>
        </li> 

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/showOfferView">Ver Propuestas</a>
        </li>       

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>jobOffer/showListHistory">Ver Historial de Postulaciones</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/logOff">Cerrar sesion</a>
        </li>        
    </ul>
    <?php } } if (!isset($_SESSION['account'])) { ?>
        <ul class="navbar-nav ml-auto">        
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/viewAccount">Iniciar Sesión</a>
            </li> 

            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>account/register">Registrarse</a>
            </li>                           
        </ul>

        <?php } ?>

</nav>