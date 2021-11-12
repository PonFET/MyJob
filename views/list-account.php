<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");
?>

<div id="listaUser">
    <div class ="container"> 
        <div class="listUser-container">
            <div class="row">
                <div class="col-9">
                    <h2> Usuarios
                </div>
            </div>
            <div class="row">
                <?php 
                foreach($arrayAccount as $account)
                {

                ?>
                <div class="col-3" style="margin-bottom:20px">
                    <div class="card">
                        <div class="card-img-top account-card container">
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"> <?php echo $account->getEmail(); ?></span>
                                    <span class="h2 border-text"> <?php echo $account->getPrivilegios(); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="container" id="crearUser">

    <div class="row">
        <div class="col-9">
            <h3> Agregar Cuenta Nueva: </h3>
        </div>
    </div>

    <div>

        <form action="<?php echo FRONT_ROOT ?>account/addAdmin" method="POST">
            <button type="submit" name="" class="btn-dark btn-sm" value="">Admin</button>
        </form>

        <br>

        <form action="<?php echo FRONT_ROOT ?>account/addStudent" method="POST">
            <button type="submit" name="" class="btn-dark btn-sm" value="">Estudiante</button>
        </form>

        <br>

        <form action="<?php echo FRONT_ROOT ?>account/addCompany" method="POST">
            <button type="submit" name="" class="btn-dark btn-sm" value="">Compañia</button>
        </form>

        <br>
        
    </div>
</div>

<?php
    require_once(VIEWS_PATH."footer.php");
?>