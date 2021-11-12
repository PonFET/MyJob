<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>account/createCompanyByA" method="POST">
                <h2>Agregar Empresa: </h2>
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
                            <label class="text-dark">Email:</label>
                            <input type="email" name="email" id="email" required>
                        </div>

                        <div>
                            <label class="text-dark">Telefono:</label>
                            <input type="number" name="phoneNumber" id="phoneNumber" required>
                        </div>

                        <div>
                            <label class="text-dark">CUIT:</label>
                            <input type="text" name="cuit" id="cuit" required>
                        </div>

                        <div>
                            <label class="text-dark">Contrasenia:</label>
                            <input type="password" name="password" id="password" required>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
</div>

<?php require_once(VIEWS_PATH."footer.php");?>