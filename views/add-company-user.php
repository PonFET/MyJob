<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/createCompany" method="POST">
                <h2>Datos de la Empresa:</h2>
                <div class="form-row">
                    <div class="form-group col-md-6">

                        <div>
                            <label class="text-dark" style="width: 68px">Nombre:</label>
                            <input type="text" name="companyName" id="companyName" required>
                        </div>

                        <div>
                            <label class="text-dark">Localizacion:</label>
                            <input type="text" name="location" id="location" required>
                        </div>

                        <div>
                            <label class="text-dark">Descripcion:</label>
                            <input type="text" name="description" id="description" required>
                        </div>

                        <div>
                            <label class="text-dark">Telefono:</label>
                            <input type="number" name="phoneNumber" id="phoneNumber" required>
                        </div>

                        <div>
                            <label class="text-dark">CUIT:</label>
                            <input type="text" name="cuit" id="cuit" required>
                        </div>

                    </div>
                </div>

                <h2>Datos de la Cuenta:</h2>

                <div class="form-row">
                    <div class="form-group col-md-9">

                        <div>
                            <label class="text-dark" style="width: 68px">Email:</label>
                            <input type="email" class="form-control mb- lg" name="email" id="email" required>
                        </div>

                        <div>
                            <label for="password" class="form-label">Contrasenia:</label>
                            <input type="password" class="form-control mb- lg" name="password" required>
                        </div>
                        <div>
                            <label for="rPassword" class="form-label">Repita la contrasenia:</label>
                            <input type="password" class="form-control mb- lg" name="rPassword" required>
                        </div>
                        
                        

                    </div>
                    <div>
                            <label for="privilegios" class="form-label"></label>
                            <input type="hidden" value="3" name="privilegios">
                        </div>
                </div>

                
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
</div>

<?php require_once(VIEWS_PATH."footer.php");?>