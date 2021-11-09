<?php 

include_once(VIEWS_PATH."nav-bar.php"); 

?>

<!-- como dejar el id de cuenta -->
<input type="hidden" value="default" name="id">
<input type="hidden" value="student" name="privilegios">
<input type="hidden" value="<?php echo $student->getStudentId() ?>">

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">

            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/create" method="POST">
                <h1>Verificar Datos:</h1>
                <div class="row d-flex justify-content-center">

                    <div class="col-3">
                        <label for="firstName">Nombre:</label>
                        <input type="text" class="form-control mb- lg" placeholder="<?php echo $student->getFirstName() ?>" value="<?php echo $student->getFirstName() ?>" disabled>
                    </div>
                    
                    <div class="col-3">
                        <label for="lastName">Apellido:</label>
                        <input type="text" class="form-control mb- lg" placeholder="<?php echo $student->getLastName() ?>" value="<?php echo $student->getLastName() ?>" disabled>
                    </div>
                    
                    <div class="col-3">
                        <label for="dni">DNI:</label>
                        <input type="number" class="form-control mb- lg" placeholder="<?php echo $student->getDni() ?>" value="<?php echo $student->getDni() ?>" disabled>
                    </div>
                    
                    <div class="col-3">
                        <label for="fileNumber">Numero de Archivo:</label>
                        <input type="text" class="form-control mb- lg" placeholder="<?php echo $student->getFileNumber() ?>" value="<?php echo $student->getFileNumber() ?>" disabled>
                    </div>
                    
                    <div class="col-3">
                        <label for="gender">Genero:</label>
                        <input type="text" class="form-control mb- lg" placeholder="<?php echo $student->getGender() ?>" value="<?php echo $student->getGender() ?>" disabled>
                    </div>
                    
                    <div class="col-3">
                        <label for="birthDate">Cumpleanios:</label>
                        <input type="text" class="form-control mb- lg" placeholder="<?php echo $student->getBirthDate() ?>" value="<?php echo $student->getBirthDate() ?>" disabled>
                    </div>

                    <div class="col-3">
                        <label for="careerId" class="form-label">Carrera:</label>
                        <input type="text" class="form-control mb- lg" placeholder="<?php echo $career->getDescription() ?>" value="<?php echo $career->getDescription() ?>" disabled>
                    </div>

                </div>

                <div class="row d-flex justify-content-center">

                    <div class="col-3">
                        <label for="password" class="form-label">Contrasenia:</label>
                        <input type="password" class="form-control mb- lg" name="password" required>
                    </div>
                    <div class="col-3">
                        <label for="rPassword" class="form-label">Repita la contrasenia:</label>
                        <input type="password" class="form-control mb- lg" name="rPassword" required>
                    </div>
                    
                </div>


                <button type="submit" class="btn btn-primary">Crear cuenta</button>
            </form>
        </div>
    </div>
</div>