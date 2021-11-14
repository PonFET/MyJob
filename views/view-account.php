<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");
?>

<div class="row justify-content-center">
    <div class="card" style="width: 35rem;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Datos</th>
                    <th scope="col">Informacion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Email: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getEmail() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Nombre: </th>
                    <td><?= (isset($_SESSION['account'])) ? $student->getFirstName() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Apellido: </th>
                    <td><?= (isset($_SESSION['account'])) ? $student->getLastName() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Dni: </th>
                    <td><?= (isset($_SESSION['account'])) ? $student->getDni() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Numero de Archivo: </th>
                    <td><?= (isset($_SESSION['account'])) ? $student->getFileNumber() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Genero: </th>
                    <td><?= (isset($_SESSION['account'])) ? $student->getGender() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Cumpleaños: </th>
                    <td><?= (isset($_SESSION['account'])) ? $student->getBirthDate() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefono: </th>
                    <td><?= (isset($_SESSION['account'])) ? $student->getPhoneNumber() : 'Vacio'; ?></td>
                </tr>
                <?php if($student->getActive() == '1') { ?>
                    <tr>
                        <th scope="row">Estado: </th>
                    <td><h5 style="color:green">ACTIVO</h5></td>
                </tr>
                <?php } else{ ?>
                    <tr>
                        <th scope="row">Estado: </th>
                        <td><h5 style="color:red">NO ACTIVO</h5></td>
                    </tr>
                    <?php } ?>
        </tbody>
    </table>
    <a href="<?= FRONT_ROOT ?>Account/editAccount" type="button">Editar Cuenta</a>
    </div>
</div>

<?php
    require_once(VIEWS_PATH."footer.php");
?>