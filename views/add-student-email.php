<?php 

include_once(VIEWS_PATH."nav-bar.php"); 

?>

<input type="hidden" value="student" name="privilegios">

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/registerStudent" method="POST">
                <h2>Ingresar Email:</h2>

                <div class="form-row">
                    <div class="col-3">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control mb- lg" name="email" required>
                    </div>
                </div>
   
                <div class="col-3">
                    <label for="privilegios" class="form-label"></label>
                    <input type="hidden" value="privilegios" name="privilegios">
                </div>

                <button type="submit" class="btn btn-primary">Continuar</button>
            </form>
        </div>
    </div>
</div>