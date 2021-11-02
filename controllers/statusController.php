<?php

namespace controllers;

use daos\DaoStudents;
use models\Account;
use controllers\AccountController as AccountController;
use daos\DaoJobOffers as daoJobOffer;

class statusController{
    function typeSession(){
        $homeController = new HomeController();
        $homeController->navBar();

        if(isset($_SESSION['account'])){
            if($_SESSION['account']->getPrivilegios()== 0){
            // logeado como admin
                $accountController = new AccountController();
                $accountController->viewAccount();
            }
            else if($_SESSION['account']->getPrivilegios()== 1){
            // logeado como usuario, lo que va a ver cuando logee
            // $daoJobOffer = new jobOfferController();
            // $daoJobOffer->listOffers();
            }
        }
        else{
            // no hay logeo
        }
    }
}
?>