<?php 

namespace Controllers;

use controllers\AccountController as AccountController;

class HomeController {

    public function Index(){

        if (isset($_SESSION['account'])){

            $accountController = new AccountController();

            if($_SESSION['account']->getPrivilegios() == "admin"){

                $accountController->showList();

            }
            else if($_SESSION['account']->getPrivilegios() == "student"){

                $accountController->viewAccount();

            }
            else if($_SESSION['account']->getPrivilegios() == "company"){
                $accountController->viewCompany();
            }
        }
        else{
            require_once(VIEWS_PATH."header.php");
            require_once(VIEWS_PATH."login.php");
        }
    }
}
?>