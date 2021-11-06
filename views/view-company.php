<?php
    require_once(VIEWS_PATH."header.php");
?>
<!-- No se usa -->

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
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getCompany()->getCompanyName() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Localizacion: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getCompany()->getLocation() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Descripcion: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getCompany()->getDescription() : 'Vacio'; ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefono: </th>
                    <td><?= (isset($_SESSION['account'])) ? $_SESSION['account']->getCompany()->getPhoneNumber() : 'Vacio'; ?></td>
                </tr>
        </tbody>
    </table>
    <a href="<?= FRONT_ROOT ?>Account/edit" type="button">Editar Cuenta</a>
    </div>
</div>

<?php
    require_once(VIEWS_PATH."footer.php");
?>