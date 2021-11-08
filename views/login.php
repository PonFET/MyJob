<?php
    //var_dump($_POST);
    include_once(VIEWS_PATH."nav-bar.php");
?>

<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/verify" method="POST">
                        <h3 class="text-center font-eight-bol">Iniciar Sesion</h3>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                            
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="invalid-feedback">
                                Password incorrecto
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                        <a href="<?= FRONT_ROOT ?>Account/register" class="btn btn-success"> Registrarse</a>
                </form>
            </div>
        </div>
</div>