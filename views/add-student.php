<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/createStudent" method="POST">
                <h1>Ingresar Estudiante:</h1>
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
                
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
</div>