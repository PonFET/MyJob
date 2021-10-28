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

    // Creo que no es necesario enviarle todos los parametros de Student, ya que este obtiene todos sus datos desde la API, recibiendo el email
    // podemos comparar con la API para saber cual student tiene el mismo email, si no existe deberiamos devolverlo al register()
    // Si hacemos esto modificar el metodo.
    public function create($studentId = 0, $careerId = 0, $firstName = "", $lastName = "", $dni = 0, $fileNumber = 0, $gender = "", $birthDate = "", $email, $phoneNumber = 0, $active = "", $password, $rPassword){
        $daoStudent = $daoStudents::GetInstance();

        // Supongo que esta linea hace la comparacion de los emails
        $_SESSION['registerValidator']['email'] = ($this->daoStudent->exist($email)) ? 'is-invalid' : 'is-valid';
        
        $_SESSION['registerValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['registerValidator']['email'] == 'is-invalid'  || $_SESSION['registerValidator']['password'] == 'is-invalid'){
            $this->register();
        }
        else{
            unset($_SESSION['registerValidator']);

            $account = new Account(0, $email, $password, 1);

            // modificar?
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

    public function viewAccount(){
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

        $daoStudent = $daoStudents::getInstance();

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

                $this->viewAccount();

            }
            catch(PDOException $p){

            }
        }
    }
    
}