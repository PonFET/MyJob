<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");
?>

<div>
    <div class ="container"> 
        <div>
            <div class="row">
                <div class="col-9">
                   <br> <h2> Ofertas Laborales a las que puede postularse </h2><br><br>
                </div>
            </div>
            <div class="row">
                <?php 
                if($student->getActive() == 1){
                
                foreach($offerList as $jobOffer)
                {
                    $show = 1;
                    foreach($jobOffer->getArrayJobPos() as $offerPos){ foreach($positionList as $jobPosition){ if($show == 1 && $jobPosition->getJobPositionId() == $offerPos && $student->getCareerId() == $jobPosition->getCareerId()){ $show = 0;
                ?>
                <div class="col-3" style="margin-bottom:20px">
                    <div class="card">
                        <div class="card-img-top jobOffer-card container"><br>
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"><b><i><?php foreach($companiesList as $company){ if($company->getCompanyId() == $jobOffer->getCompanyId()){ echo $company->getCompanyName(); } } ?></i></b></span><br> está en búsqueda de...
                                </div>
                            </div>

                            <hr style="height: 2px;">

                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <?php
                                    $rowImg = 
                                    $jobOffer->getOfferId();
                                    while($rowImg = mysqli_fetch_assoc($resultImg)){
                                        //la muestra
                                        echo "<div>";

                                            if($rowImg['status'] == 0){
                                                echo "<img src='uploads/profile".$id.".jpg?'".mt_rand().">";
                                            }
                                            else{
                                                echo "<img src='uploads/No-image-available.png'>";
                                            }
                                            echo "<p>" . $row['username'] . "</p>";

                                        echo "</div>";
                                    }
                                    ?>
                                </div>
                            </div><br><br>
                        
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h3 border-text"><u><?php echo $jobOffer->getOfferDescription(); ?></u></span>
                                </div>
                            </div><br><br>

                            <div class="row" style="height:inherit">
                                <?php foreach($positionList as $position){ foreach($jobOffer->getArrayJobPos() as $posId){ if($position->getJobPositionId() == $posId){ ?>
                                <div class="col align-self-center">                                    
                                    # <?php echo $position->getDescription() ?><br>
                                </div> <?php } } } ?>
                            </div><br><br>

                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h5 border-text"><i>Fecha límite de postulación: <br></i> <?php echo $jobOffer->getEndDate(); ?></span>
                                </div>
                            </div>

                            <?php
                                $postulated = 0;
                                if(!empty($jxaList)){ foreach($jxaList as $jxa){ if(($jxa['accountId'] == $_SESSION['account']->getId()) && ($jxa['offerId'] == $jobOffer->getOfferId())){ $postulated = 1; } } }                                
                            ?>
                            
                            <?php if($postulated == 0){ ?>
                            <form action="<?= FRONT_ROOT ?>jobOffer/studentPostulationAdd" method="POST">
                                
                                <input type="hidden" name="offerId" value='<?php echo $jobOffer->getOfferId(); ?>'>

                                <br><button type="submit" class="btn btn-primary">Enviar Postulacion</button>

                            </form><br>
                            <?php } elseif($postulated == 1){ ?>
                                <br><button class="btn btn-success" disabled>Postulación enviada</button><br>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } } } } } else{ echo '<h3 style="color:red;">Usted se encuentra en estado inactivo, por lo tanto no puede acceder al sistema de postulaciones, si cree que esto es un error contactese con el Departamento de Alumnos.</h1>'; } ?>
                
            </div>
        </div>
    </div>
</div>

<?php
    require_once(VIEWS_PATH."footer.php");
?>