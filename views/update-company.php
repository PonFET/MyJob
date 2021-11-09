<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");    
?>

<table border="2" align="center" cellspacing="5px">
        <div>
		    <tr align="center" >
                <td><br>
		            <label style="border: 2px; border-radius: 2px; background-color: red; color: white; font-size: 22px; padding: 2px; font-style: verdana">Actualizar Empresa</label>
                    <p>
                        <div>
                            <label >Nombre:</label>
                            <input type="text" name="companyName" id="companyName" disabled placeholder="<?php echo $company->getCompanyName();?>" >
                        </div>
                        <div>
                            <label >Localizacion:</label>
                            <input type="text" name="location" id="location" disabled placeholder="<?php echo $company->getLocation();?>" >
                        </div>
                        <div>
                            <label >Descripcion:</label>
                            <input type="text" name="description" id="description" disabled placeholder="<?php echo $company->getDescription();?>" >
                        </div>
                        <div>
                            <label >Email:</label>
                            <input type="text" name="email" id="email" disabled placeholder="<?php echo $company->getEmail();?>" >
                        </div>
                        <div>
                            <label >Telefono:</label>
                            <input type="text" name="phoneNumber" id="phoneNumber" disabled placeholder="<?php echo $company->getPhoneNumber();?>" >
                        </div>
                        <div>
                            <label >CUIT:</label>
                            <input type="text" name="phoneNumber" id="phoneNumber" disabled placeholder="<?php echo $company->getCuit();?>" >
                        </div>
                        <hr>
                    </p>
		        </td>
            </tr>
            <tr align="center">
                <td>
                    <form action="<?php echo FRONT_ROOT ;?>Company/modify" method="POST"> 
                        <input type="hidden" name="companyId" value='<?php echo $company->getCompanyId(); ?>'>
                        <p>
                            <table width="600px">
                                <tr>
                                    <td>
                                        <div>
                                            <label  style="width: 70px" required>Nombre: </label>
                                            <input type="text" name="companyName"></input>
                                        </div>
                                        <div>
                                            <label  required>Localizacion:</label>
                                            <input type="text" name="location"></input>
                                        </div>
                                        <div>
                                            <label  required>Descripcion:</label>
                                            <input type="text" name="description"></input>
                                        </div>
                                        <div>
                                            <label  required>Email:</label>
                                            <input type="text" name="email"></input>
                                        </div>
                                        <div>
                                            <label  required>Telefono:</label>
                                            <input type="text" name="phoneNumber"></input>
                                        </div>
                                        <div>
                                            <label  required>CUIT:</label>
                                            <input type="text" name="cuit"></input>
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