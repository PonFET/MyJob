<?php 

include_once(VIEWS_PATH."nav-bar.php"); 

if($message != '')
{
    echo '<script language="javascript">alert("' . $message . '");</script>';
}

?>


<div class="container-fluid">
    <div class="row justify-content-center">

            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/createStudentByA" method="POST">
                <h2>Verificar Datos:</h2>
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
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control mb- lg" name="password" required>
                    </div>
                    <div class="col-3">
                        <label for="rPassword" class="form-label">Repita la contraseña:</label>
                        <input type="password" class="form-control mb- lg" name="rPassword" required>
                    </div>

                </div>

                <br>

                <div>
                    <div class="col-3">
                        <label for="email" class="form-label"></label>
                        <input type="hidden" value="<?php echo $student->getEmail(); ?>" name="email">
                    </div>
                    <div class="col-3">
                        <label for="privilegios" class="form-label"></label>
                        <input type="hidden" value="2" name="privilegios">
                    </div>
                </div>


                <div>
                    <button type="submit" class="btn btn-primary">Crear cuenta</button>
                </div>

            </form>
        
    </div>
</div>