<?php
    include_once(VIEWS_PATH."nav-bar.php");
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
                    <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getEmail() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Nombre: </th>
                    <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getStudent()->getFirstName() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Apellido: </th>
                    <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getStudent()->getLastName() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Dni: </th>
                    <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getStudent()->getDni() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Numero de Archivo: </th>
                    <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getStudent()->getFileNumber() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Genero: </th>
                    <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getStudent()->getGender() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Cumpleaños: </th>
                    <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getStudent()->getBirthDate() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefono: </th>
                    <td><?= (isset($_SESSION['cuenta'])) ? $_SESSION['cuenta']->getStudent()->getPhoneNumber() : 'Vacio'; ?></td>
                </tr>
        </tbody>
    </table>
    <a href="<?= FRONT_ROOT ?>AccountController/edit" type="button">Editar Cuenta</a>
    </div>
</div>

<?php
    include_once(VIEWS_PATH."footer.php");
?>