<?php
    require_once(VIEWS_PATH."nav-bar.php");
    require_once(VIEWS_PATH."header.php");
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>AccountController/update" method="POST">

                <h1>Actualizar</h1>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        
                        <label for="inputEmail4">Email</label>

                        <input type="email" class="form-control" id="inputEmail4" name="email" 
                         value= "<?= (isset($_SESSION['account']))? $_SESSION['account']->getEmail() : 'Vacio'; ?>" >
                        
                        <div class="invalid-feedback">
                             El email ya se encuentra en uso
                        </div>

                    </div>
                    <div class="form-group col-md-6">

                        <label for="inputPassword4">Password</label>

                        <input type="password" class="form-control <?php if(isset($_SESSION['updateValidator'])) echo $_SESSION['updateValidator']['password']; ?>" id="inputPassword4" name="password"
                        value="<?= (isset($_SESSION['account']))? $_SESSION['account']->getPassword() : 'Vacio'; ?>">

                        <div class="invalid-feedback">
                             El password no coincide
                        </div>

                    </div>
                </div>

                <div class="form-group">
                        <label for="inputPassword4">Repetir Password</label>
                        <input type="password" class="form-control <?php if(isset($_SESSION['updateValidator'])) echo $_SESSION['updateValidator']['password']; ?>" id="inputPassword4" name="rPassword">
                </div>
                
                <button type="submit" class="btn btn-primary">Actualizar</button>

            </form>
        </div>
    </div>
</div>

<?php require_once(VIEWS_PATH."footer.php");?>