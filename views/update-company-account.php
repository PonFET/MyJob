<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");

    if($message != '')
        {
            echo '<script language="javascript">alert("' . $message . '");</script>';
        }
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>account/updateCompanyAccount" method="POST">
                <h2>Agregar Empresa: </h2>
                <div class="form-row">
                    <div class="form-group col-md-6">

                        <div>
                            <label class="text-dark" style="width: 68px">Nombre:</label>
                            <input type="text" name="companyName" id="companyName" value="<?php echo $company->getCompanyName(); ?>" required>
                        </div>

                        <div>
                            <label class="text-dark">Localizacion:</label>
                            <input type="text" name="location" id="location" value="<?php echo $company->getLocation(); ?>" required>
                        </div>

                        <div>
                            <label class="text-dark">Descripcion:</label>
                            <input type="text" name="description" id="description" value="<?php echo $company->getDescription(); ?>" required>
                        </div>

                        <div>
                            <label class="text-dark">Telefono:</label>
                            <input type="number" name="phoneNumber" id="phoneNumber" value="<?php echo $company->getPhoneNumber(); ?>" required>
                        </div>

                        <div>
                            <label class="text-dark">CUIT:</label>
                            <input type="text" name="cuit" id="cuit" value="<?php echo $company->getCuit(); ?>" required>
                        </div>

                        <div>
                            <label class="text-dark">Email:</label>
                            <input type="email" name="email" id="email" value="<?php echo $company->getEmail(); ?>" required>
                        </div> 

                        <div>
                            <label class="text-dark">Contraseña actual:</label>
                            <input type="password" name="aPassword" id="password" value="aaaaaaaaaa" required>
                        </div>

                        <div>
                            <label class="text-dark">Contraseña nueva:</label>
                            <input type="password" name="nPassword" id="password" required>
                        </div>

                        <div>
                            <label class="text-dark">Repetir nueva Contraseña:</label>
                            <input type="password" name="rNPassword" id="password"  required>
                        </div>

                        <input type="hidden" name="companyId" value="<?php echo $company->getCompanyId(); ?>">

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Modificar</button>
            </form>
        </div>
    </div>
</div>

<?php require_once(VIEWS_PATH."footer.php");?>