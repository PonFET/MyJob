<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");    
?>
<br>
<div>
    <div class ="container"> 
        <div>
            <div class="row">
                <div class="col-9">
                    <h2> Empresas
                </div><hr>
            </div><br>
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
                                    <span class="h1 border-text"> <?php echo $company->getCompanyName(); ?></span><br>
                                    <span class="h6 border-text"> <?php echo $company->getLocation(); ?></span><br>
                                    <span class="h6 border-text"> <?php echo $company->getDescription(); ?></span><br>
                                    <span class="h6 border-text"> <?php echo $company->getEmail(); ?></span><br>
                                    <span class="h6 border-text"> <?php echo $company->getPhoneNumber(); ?></span><br>
                                    <span class="h6 border-text"> <?php echo $company->getCuit(); ?></span>
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
    require_once(VIEWS_PATH."footer.php");
?>