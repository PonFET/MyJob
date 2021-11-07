<?php
    require_once(VIEWS_PATH."header.php");
?>

<table border="2" align="center" cellspacing="5px">
        <div>
		    <tr align="center" >
                <td><br>
		            <label style="border: 2px; border-radius: 2px; background-color: red; color: white; font-size: 22px; padding: 2px; font-style: verdana">Actualizar Compañia</label>
                    <p>
                        <div>
                            <label class="text-light">Nombre:</label>
                            <input type="text" name="companyName" id="companyName" disabled placeholder="<?php echo $company->getCompanyName();?>" >
                        </div>
                        <div>
                            <label class="text-light">Localizacion:</label>
                            <input type="text" name="location" id="location" disabled placeholder="<?php echo $company->getLocation();?>" >
                        </div>
                        <div>
                            <label class="text-light">Descripcion:</label>
                            <input type="text" name="description" id="description" disabled placeholder="<?php echo $company->getDescription();?>" >
                        </div>
                        <div>
                            <label class="text-light">Email:</label>
                            <input type="text" name="email" id="email" disabled placeholder="<?php echo $company->getEmail();?>" >
                        </div>
                        <div>
                            <label class="text-light">Telefono:</label>
                            <input type="text" name="phoneNumber" id="phoneNumber" disabled placeholder="<?php echo $company->getPhoneNumber();?>" >
                        </div>
                        <hr>
                    </p>
		        </td>
            </tr>
            <tr align="center">
                <td>
                    <form action="<?php echo FRONT_ROOT ;?>/Company/update" method="POST"> 
                        <input type="hidden" name="companyId" value='<?php echo $company->getCompanyId(); ?>'>
                        <p>
                            <table width="600px">
                                <tr>
                                    <td>
                                        <div>
                                            <label class="text-light" style="width: 70px" required>Nombre: </label>
                                            <input type="text" name="companyName"></input>
                                        </div>
                                        <div>
                                            <label class="text-light" required>Localizacion:</label>
                                            <input type="text" name="location"></input>
                                        </div>
                                        <div>
                                            <label class="text-light" required>Descripcion:</label>
                                            <input type="text" name="description"></input>
                                        </div>
                                        <div>
                                            <label class="text-light" required>Email:</label>
                                            <input type="text" name="email"></input>
                                        </div>
                                        <div>
                                            <label class="text-light" required>Telefono:</label>
                                            <input type="text" name="phoneNumber"></input>
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