<?php
    require_once(VIEWS_PATH."header.php");
?>

<div id="listaUser">
    <div class ="container"> 
        <div class="listUser-container">
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
                                    <span class="h2 border-text"> <?php echo $jobOffer->offerDescription(); ?></span>
                                </div>
                            </div>
                            <form action="<?= FRONT_ROOT ?>jobOfferController/postulation" method="POST">
                                
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