<?php
    include_once(VIEWS_PATH."nav-bar.php");
    
    if($message != '')
        {
            echo '<script language="javascript">alert("' . $message . '");</script>';
        }
?>
<br><br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>Account/confirmPriv" method="POST">
                <h1>Elija su Rol</h1>
                
                <div class="row">
                    <div>
                        <select name="select">
                            <option value="student" name="privilegios" id="student" selected>Estudiante</option>
                            <option value="company" name="privilegios" id="company">Compañia</option>
                        </select>
                    </div>
                </div>
                
                <br>
                
                <button type="submit" class="btn btn-primary">Continuar</button>
            </form>
        </div>
    </div>
</div>
<br><br>
<?php include_once(VIEWS_PATH . "footer.php"); ?>