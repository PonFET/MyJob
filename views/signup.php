<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/create" method="POST">
                <h1>Registro</h1>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control <?php if(isset($_SESSION['registerValidator'])) echo $_SESSION['registerValidator']['email']; ?>" id="inputEmail4" name="email" 
                         value= "<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                        <div class="invalid-feedback">
                             El email ya se encuentra en uso
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control <?php if(isset($_SESSION['registerValidator'])) echo $_SESSION['registerValidator']['password']; ?>" id="inputPassword4" name="password"
                        value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>">
                        <div class="invalid-feedback">
                             El password no coincide
                        </div>
                    </div>

                </div>

                <div class="form-group">
                        <label for="inputPassword4">Repetir Password</label>
                        <input type="password" class="form-control <?php if(isset($_SESSION['registerValidator'])) echo $_SESSION['registerValidator']['password']; ?>" id="inputPassword4" name="rPassword">
                </div>
                
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
        </div>
    </div>
</div>
<!--Si usamos el create de account con los parametros de student llamandolos: create(studentid, etc), tendriamos que crear aqui los input"hidden" que guarden la informacion.
    Ya que si se ingresa un mail que no es de la API no deberia ser posible crear la cuenta de usuario, avisandole al creador que no tiene email en la API o la cuenta ya existe.
    Entonces tendriamos que permitir que se ingresen los datos email y password, hacer que la funcione compare con la API si tiene un mail identico y ahi igualar los datos que
    tenga ese student para ingresarlo a los parametros del create.
    Esto deberian ser especificaiones adheridas al propio create sea de account o de student.
->