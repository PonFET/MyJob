<?php
    require_once(VIEWS_PATH."header.php");
    include_once(VIEWS_PATH."nav-bar.php");    
?>

<div class="row justify-content-center">
    <div class="card" style="width: 35rem;">
        <table class="table table-hover">
            <thead>
                
            </thead>
            <tbody>                
                <tr>
                    <th scope="row">Nombre: </th>
                    <td><?php echo $company->getCompanyName(); ?></td>
                </tr>
                <tr>
                    <th scope="row">Ubicación: </th>
                    <td><?php echo $company->getLocation(); ?></td>
                </tr>
                <tr>
                    <th scope="row">Descripcion: </th>
                    <td><?php echo $company->getDescription() ; ?></td>
                </tr>
                <tr>
                    <th scope="row">E-mail: </th>
                    <td><?php echo $company->getEmail(); ?></td>
                </tr>
                <tr>
                    <th scope="row">Teléfono: </th>
                    <td><?php echo $company->getPhoneNumber(); ?></td>
                </tr>
        </tbody>
    </table>
    <a href="<?= FRONT_ROOT ?>Account/edit" type="button">Editar Cuenta</a>
    </div>
</div>

<?php
    require_once(VIEWS_PATH."footer.php");
?>