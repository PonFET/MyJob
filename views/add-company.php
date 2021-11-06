<?php
    require_once(VIEWS_PATH."header.php");
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Company/add" method="POST">
                <h1>Agregar Compañia</h1>
                <div class="form-row">
                    <div class="form-group col-md-6">

                        <div>
                            <label for="cine" class="text-light" style="width: 68px">Nombre:</label>
                            <input type="text" name="companyName" id="companyName" required>
                        </div>

                        <div>
                            <label for="cine" class="text-light">Localizacion:</label>
                            <input type="text" name="location" id="location" required>
                        </div>

                        <div>
                            <label for="cine" class="text-light">Descripcion:</label>
                            <input type="text" name="description" id="description" required>
                        </div>

                        <div>
                            <label for="cine" class="text-light">Email:</label>
                            <input type="text" name="email" id="email" required>
                        </div>

                        <div>
                            <label for="cine" class="text-light">Telefono:</label>
                            <input type="text" name="phoneNumber" id="phoneNumber" required>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
</div>

<?php require_once(VIEWS_PATH."footer.php");?>