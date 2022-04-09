<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");   
    $upload_dir = 'views/image/'; 
?>
<br>
<div id="listaUser">
    <div class ="container"> 
        <div class="listUser-container">
            <div class="row">
                <div class="col-9">
                    <h2> Ofertas Laborales a las que se Postuló
                </div>
            </div>
            <div class="row">
                <?php 
                foreach($offerList as $jobOffer)
                {

                ?>
                <div class="col-3" style="margin-bottom:20px">
                    <div class="card">
                        <div class="card-img-top jobOffer-card container">
                            
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text">Compañía: <?php foreach($companiesList as $company)
                                                                                 {                                                                                    
                                                                                    if($company->getCompanyId() == $jobOffer->getCompanyId())
                                                                                    {
                                                                                        echo $company->getCompanyName();
                                                                                    }
                                                                                 } ?>
                                    </span>
                                </div>
                            </div> <br>
                            
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <img src="<?php echo $upload_dir.$jobOffer->getOfferImg(); ?>" height="60">
                                </div>
                            </div><br><br>

                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"> <?php echo $jobOffer->getOfferDescription(); ?></span>
                                </div>
                            </div><br>

                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text">Finalización de búsqueda: <?php echo $jobOffer->getEndDate(); ?></span>
                                </div>
                            </div><br>
                            
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text">Posiciones buscadas:
                                        <?php foreach($jobOffer->getArrayJobPos() as $jobPos){ foreach($positionList as $posList){ if($posList->getJobPositionId() == $jobPos){ echo '<br> #' . $posList->getDescription(); } } } ?>
                                    </span>
                                </div>
                            </div><br>

                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="border-text"><?php if($jobOffer->getEnable() == 1){ echo '<h2 style="color:green;">Búsqueda Activa</h2>'; } else{ echo '<h2 style="color:red";>Búsqueda Finalizada</h2>'; } ?></span>
                                </div>
                            </div><br>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<br><br>
<?php
    require_once(VIEWS_PATH."footer.php");
?>