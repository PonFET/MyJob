<?php
    include_once(VIEWS_PATH."header.php");
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
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getStudent()->getFirstName() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Apellido: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getStudent()->getLastName() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Dni: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getStudent()->getDni() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Numero de Archivo: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getStudent()->getFileNumber() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Genero: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getStudent()->getGender() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Cumpleaños: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getStudent()->getBirthDate() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefono: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getStudent()->getPhoneNumber() : 'Vacio'; ?></td>
                </tr>
        </tbody>
    </table>
    <a href="<?= FRONT_ROOT ?>AccountController/edit" type="button">Editar Cuenta</a>
    </div>
</div>

<?php
    include_once(VIEWS_PATH."footer.php");
?>