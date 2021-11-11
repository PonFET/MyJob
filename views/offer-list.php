<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");
?>

<div>
    <div class ="container"> 
        <div>
            <div class="row">
                <div class="col-9">
                    <h2> Ofertas Laborales
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
                                    <span class="h2 border-text"> <?php echo $jobOffer->getOfferDescription(); ?></span>
                                </div>
                            </div>

                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"> <?php echo $jobOffer->getStartDate(); ?></span>
                                </div>
                            </div>

                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"> <?php echo $jobOffer->getEndDate(); ?></span>
                                </div>
                            </div>

                            <form action="<?= FRONT_ROOT ?>jobOffer/studentPostulationAdd" method="POST">
                                
                                <input type="hidden" name="offerId" value='<?php echo $jobOffer->getOfferId(); ?>'>

                                <button type="submit" class="btn btn-primary">Enviar Postulacion</button>

                            </form>
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