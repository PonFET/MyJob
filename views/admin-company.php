<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");    
?>

<div>
    <div class ="container"> 
        <div>
            <div class="row">
                <div class="col-9">
                    <h2> Empresas </h2>
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
                                    <form class="" action="<?php echo FRONT_ROOT ?>company/delete" method="POST">
                                        <button type="submit" name="companyId" class="btn-dark btn-sm" value="<?php echo $company->getCompanyId(); ?>">Eliminar</button>
                                    </form>
                                    <form action="<?php echo FRONT_ROOT ?>company/showModify" method="POST">
                                        <button type="submit"  name="companyId" class="btn-dark btn-sm" value="<?php echo $company->getCompanyId(); ?>">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php } ?>

                
                <form action="<?php echo FRONT_ROOT ?>account/addCompany" method="POST">
                    <button type="submit"  name="companyId" class="btn-dark btn-sm">Agregar</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

<?php
    require_once(VIEWS_PATH."footer.php");
?>