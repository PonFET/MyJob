<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");    
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 "><br>
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>JobOffer/add" method="POST">
                <h1>Agregar Oferta Laboral</h1>
                <div class="form-row">
                    <div class="form-group col-md-6">

                        <div>
                            <label class="text-dark" style="width: 68px">Compañía:</label><br>
                            <select name="companyId" id="companyId" required>
                                <?php if($_SESSION['account']->getPrivilegios() == 'company'){ ?>
                                    <?php foreach($companiesList as $company) { if($company->getEmail() == $_SESSION["account"]->getEmail()){ ?>
                                        <option value="<?php echo $company->getCompanyId(); ?>"><?php echo $company->getCompanyName(); ?></option>
                                    <?php } } } else{ ?><br>                                    
                                        <?php foreach($companiesList as $company) {  ?>
                                        <option value="<?php echo $company->getCompanyId(); ?>"><?php echo $company->getCompanyName(); ?></option>
                                        <?php } } ?><br>
                        </div><br>

                        <div><br>
                            <label class="text-dark">Descripción:</label>
                            <input type="text" name="offerDescription" id="offerDescription" required>
                        </div><br>

                        

                        <div>
                            <label class="text-dark">Fecha de Finalización:</label>
                            <input type="datetime-local" name="endDate" id="endDate" required>
                        </div><br>

                        <div>
                            <label class="text-dark" style="width: 68px">Posiciones a buscar:</label>                            
                                    <?php foreach($positionList as $jobPosition) { ?>
                                        <tr><br>
                                            <td>
                                                <input type="checkbox" name="jobPositionIdArray[]" id="jobPositionIdArray[]" value="<?php echo $jobPosition->getJobPositionId(); ?>">                                                
                                            </td>
                                            <td>
                                                <?php echo $jobPosition->getDescription(); ?>
                                            </td>                                            
                                        </tr>
                                    <?php } ?>
                        </div>
                        

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
</div>

<?php require_once(VIEWS_PATH."footer.php");?>