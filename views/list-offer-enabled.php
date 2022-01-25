<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");
?>

<div id="listaUser">
    <div class ="container"> 
        <div class="listUser-container">
            <div class="row">
                <div class="col-9">
                    <h2> Ofertas Laborales Activas
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
                                    <span class="h2 border-text"> <?php echo $jobOffer->getOfferDescription(); ?></span>
                                </div>
                            </div> <br>

                            

                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"> <?php echo $jobOffer->getEndDate(); ?></span>
                                </div>
                            </div> <br>
                            
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text">Posiciones buscadas: <br>
                                    <?php foreach($jobOffer->getArrayJobPos() as $jobPos){ foreach($positionList as $posList){ if($posList->getJobPositionId() == $jobPos){ echo '# ' . $posList->getDescription() . '<br>'; } } } ?>
                                    </span>
                                </div>
                            </div>

                            
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <img src="<?php echo $jobOffer->getOfferImg(); ?>" height="60">
                                </div>
                            </div><br><br>
                            
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