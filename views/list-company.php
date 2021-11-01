<?php
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
                                    <span class="h2 border-text"> <?php echo $company->getLocation(); ?></span>
                                    <span class="h2 border-text"> <?php echo $company->getDescription(); ?></span>
                                    <span class="h2 border-text"> <?php echo $company->getEmail(); ?></span>
                                    <span class="h2 border-text"> <?php echo $company->getPhoneNumber(); ?></span>
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