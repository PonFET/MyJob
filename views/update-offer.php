<?php
    require_once(VIEWS_PATH."header.php");
?>

<table border="2" align="center" cellspacing="5px">
        <div>
		    <tr align="center" >
                <td><br>
		            <label style="border: 2px; border-radius: 2px; background-color: red; color: white; font-size: 22px; padding: 2px; font-style: verdana">Actualizar Oferta Laboral</label>
                    <p>
                        <div>
                            <label class="text-light">Compañía:</label>
                            <input type="text" name="companyName" id="companyName" disabled placeholder="<?php echo $company->getCompanyName();?>" >
                        </div>
                        <div>
                            <label class="text-light">Descripción:</label>
                            <input type="text" name="location" id="location" disabled placeholder="<?php echo $company->getLocation();?>" >
                        </div>
                        <div>
                            <label class="text-light">Posiciones buscadas:</label>
                            <?php foreach($jobOffer->getArrayJobPos() as $jobPos) {
                                ?>
                            <input type="text" name="description" id="description" disabled placeholder="<?php echo $jobPos() . "-";?>" > <?php ; }?>
                        </div>                       
                        <hr>
                    </p>
		        </td>
            </tr>
            <tr align="center">
                <td>
                    <form action="<?php echo FRONT_ROOT ;?>/JobOffer/update" method="POST"> 
                        <input type="hidden" name="offerId" value='<?php echo $jobOffer->getOfferId(); ?>'>
                        <p>
                            <table width="600px">
                                <tr>
                                    <td>                                        
                                        <div>
                                            <label class="text-light" required>Descripción: </label>
                                            <input type="textarea" name="offerDescription"></input>
                                        </div>                                                                               
                                    </td>
                                </tr>
                            </table>
                        </p>
                        <div>
                            <button type="submit" class='btn text-light'  style="background-color: red; font-size: 17px; border-radius: 4px; width: 150px">Actualizar</button>
                        </div>
                    </form>
		        </td>
            </tr>
        </div>
    </table>

<?php require_once(VIEWS_PATH."footer.php");?>