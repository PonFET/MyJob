<?php
namespace controllers;

use daos\DaoAccounts as daoAccounts;
use models\Account as Account;
use daos\DaoStudents;
use models\Student as Student;
use PDOException;

class accountControllers{
    private $daoAccount;
    private $statusController;
    private $loginController;

    function __construct(){
        $this->daoAccount = daoAccounts::GetInstance();
        $this->statusController = new StatusController();
        $this->loginController = new LoginController();
    }

    public function verify($email = "", $password = ""){
        if($this->daoAccount->exist($email)){
            $account = $this->daoAccount->getByEmail($email);

            if($account->getPassword() == $password){
                $_SESSION["account"] = $account;
                $this->statusController->typeSession();
            }
            else{
                $_SESSION["loginValidator"]["passValidator"] = "is-invalid";
                $_SESSION["loginValidator"]["emailValidator"] = "is-valid";
                $this->loginController->init();
            }
        }
        else{
            $_SESSION["loginValidator"]["emailValidator"] = "is-invalid";
            $this->loginController->init();
        }
    }

    public function register(){
        include "views/signup.php";
    }

    public function create($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active, $password, $rPassword){
        $daoStudent = $daoStudents::GetInstance();

        $_SESSION['registerValidator']['email'] = ($this->daoAccount->exist($email)) ? 'is-invalid' : 'is-valid';
        
        $_SESSION['registerValidator']['dni'] = ($daoStudent->exist($email)) ? 'is-invalid' : 'is-valid';
        
        $_SESSION['registerValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['registerValidator']['email'] == 'is-valid' || $_SESSION['registerValidator']['dni'] == 'is-valid' || $_SESSION['registerValidator']['password'] == 'is-valid'){
            $this->register();
        }
        else{
            unset($_SESSION['registerValidator']);

            $account = new Account(0, $email, $password, 1);

            $account->setStudent(new Student($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active));

            try{
                $this->daoAccount->add($account);

                $_SESSION['account'] = $account;

                $statusController = new StatusController();
                $statusController->typeSession();

            }
            catch(PDOException $p){

            }
        }
    }

    public function logOff(){
        unset($_SESSION['access_token']);
        
        unset($_SESSION['account']);
        
        unset($_SESSION['loginValidator']);

        session_destroy();
        
        unset($_SESSION['loginValidator']); 

        $loginController = new LoginController();
        $loginController->init();
    }

    public function viewPerfil(){
        if(isset($_SESSION['account'])){
            include ROOT . VIEWS_PATH . "nav-bar.php";
            include ROOT . VIEWS_PATH . "view-account.php";
        }else{
            require_once("views/login.php");
        }
    }

    public function editAccount(){
        include ROOT . VIEWS_PATH . "update-account.php";
    }

    public function update($email, $password, $rPassword){

        $daoPerfil = $daoPerfiles::getInstance();

        $accountOriginal = $_SESSION['account'];
        
        $_SESSION['updateValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['updateValidator']['password'] == 'is-valid'){
            $this->editAccount();
        }
        else{
            unset($_SESSION['updateValidator']);

            $accountOriginal->setEmail($email);
            $accountOriginal->setPassword($password);

            try{
                $this->daoAccount->update($account);

                $_SESSION['account'] = $accountOriginal;

                $this->viewPerfil();

            }
            catch(PDOException $p){

            }
        }
    }
    
}