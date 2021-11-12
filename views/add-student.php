<?php 
    include_once(VIEWS_PATH."nav-bar.php"); 
    {
        echo '<script>alert(' . $message . ')</script>';
    }

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/createStudentByA" method="POST">
                <h2>Ingresar mail del Estudiante:</h2>
                <div class="form-row">

                    <div class="form-row">
                        <div class="col-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control mb- lg" name="email" required>
                        </div>
                    </div>

                    <div class="col-3">
                        <label for="password" class="form-label">Contrasenia:</label>
                        <input type="password" class="form-control mb- lg" name="password" required>
                    </div>

                </div>
                
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
</div>


<?php require_once(VIEWS_PATH . 'footer.php'); ?>