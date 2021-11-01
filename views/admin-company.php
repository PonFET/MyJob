<?php
    include_once(VIEWS_PATH."nav-bar.php");
    include_once(VIEWS_PATH."header.php");
?>

<div id="listaUser">
    <div class ="container"> 
        <div class="listUser-container">
            <div class="row">
                <div class="col-9">
                    <h2> Compañias
                </div>
            </div>
            <div class="row">
                <?php 
                foreach($arrayCompany as $company)
                {

                ?>
                <div class="col-3" style="margin-bottom:20px">
                    <div class="card">
                        <div class="card-img-top company-card container">
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"> <?php echo $company->getCompanyName(); ?></span>
                                </div>
                                        
                                <div class="card-body">
                                    <form class="" action="<?php echo FRONT_ROOT?>companyController/delete" method="POST">
                                        <button type="submit" name="idCine" class="btn-dark btn-sm" value="<?php echo $company->getCompanyId() ?>">Eliminar</button>
                                    </form>
                                    <form action="<?php echo FRONT_ROOT?>companyController/addUp" method="POST">
                                        <button type="submit"  name="idCine" class="btn-dark btn-sm" value="<?php echo $company->getCompanyId(); ?>">Agregar</button>
                                    </form>
                                    <form action="<?php echo FRONT_ROOT?>companyController/modify" method="POST">
                                        <button type="submit"  name="idCine" class="btn-dark btn-sm" value="<?php echo $company->getCompanyId(); ?>">Actualizar</button>
                                    </form>
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

<?php
    include_once(VIEWS_PATH."footer.php");
?>