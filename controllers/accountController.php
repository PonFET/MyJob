<?php
namespace Controllers;

use Daos\DaoAccounts as DaoAccounts;
use models\Account as Account;
use Daos\DaoStudents as DaoStudents;
use models\Student as Student;
use Daos\DaoCompanies as DaoCompanies;
use models\Company as Company;
use PDOException;



class AccountController{
    private $daoAccount;
    private $daoStudent; 
    private $daoCompany;  
      

    function __construct(){
        $this->daoAccount = daoAccounts::GetInstance();
        $this->daoStudent = new DaoStudents(); 
        $this->daoCompany = new DaoCompanies(); 
        
    }

    public function verify($email='', $password='')
    {        
        if($this->daoAccount->exist($email))
        {
            $accountAux = new Account();
            $accountAux = $this->daoAccount->getByEmail($email);

            if($accountAux->getPassword() == $password)
            {                
                $_SESSION["account"] = $accountAux;
                
                header("Location: showList");
            }
        }
        else
        {
            //no existe   
            require_once(VIEWS_PATH."login.php");
        }
    }

    public function register($message=''){
        require_once "views/confirmPriv.php";
    }

    public function confirmPriv($privilegios){

        try{

            $_SESSION["privilegios"] = $privilegios;

            if($privilegios == "student"){
                require_once(VIEWS_PATH."add-student-email.php");
            }
            else{
                require_once(VIEWS_PATH."add-company-user.php");
            }
        }
        catch(PDOException $p){

        }

    }

    public function registerStudent($email, $privilegios){

        if($this->daoAccount->exist($email) == true){

            $this->register($message='El mail ya está registrado en Base de Datos.');
        }
        else if($this->daoStudent->existAPI($email) == true){

            $this->register($message='El mail no está registrado en API.');
            
        }
        else{

                $_SESSION["email"] = $email;
                $_SESSION["privilegios"] = $privilegios;
                header("location:".FRONT_ROOT."Student/addPassword");

        }

    }

    public function create($email, $password, $rPassword, $privilegios){

        try{
            
            if($password == $rPassword){
                               
                $account = new Account($email, $password, $privilegios);
      
                $this->daoAccount->add($account);
                
               /* $_SESSION["account"] = $account;
                
                header("Location: showListStudent");*/

                require_once "views/offer-list.php";

            }
            else{

                //la contraseña no coincide
                $_SESSION["email"] = $email;
                $_SESSION["privilegios"] = $privilegios;
                header("location:".FRONT_ROOT."Student/addPassword");

            }
        }

        catch(PDOException $p){
        }

    }

    public function createCompany($companyName,$location, $description, $phoneNumber, $cuit, $email, $password, $rPassword, $privilegios){

        try{
            if($this->daoCompany->exist($email) == true){

                $this->register($message='El mail ya está registrado en Base de Datos.');

            }

            if($password == $rPassword){
                               
                $account = new Account($email, $password, $privilegios);
      
                $this->daoAccount->add($account);

                $company = new Company($companyName, $location, $description, $email, $phoneNumber, $cuit);

                $this->daoCompany->add($company);

                $_SESSION["account"] = $account;
                
                header("Location: showListCompany");

            }
            else{

                //la contraseña no coincide
                $this->register($message='La contraseña no coincide.');

            }
        }

        catch(PDOException $p){
        }

    }

    // Es identico al de arriba, solo que no se inicia sesion cuando se crea la cuenta, admin crea cuenta student
    public function createStudent($email, $password){
        $daoStudent = $this->daoStudent::GetInstance();

        if($this->daoAccount->exist($email) == true){

            $this->addStudent($message='El mail ya está registrado en Base de Datos.');
        }
        else if($this->daoStudent->existAPI($email) == true){

            $this->addStudent($message='El mail no está registrado en API.');
            
        }

        else{

            try{
                $account = new Account($email, $password, "student");

                $this->daoAccount->add($account);

                header("Location: showList");

            }
            catch(PDOException $p){

            }
        }
    }

    // admin crea cuenta admin

    public function createAdmin($email, $password){

        if($this->daoAccount->exist($email) == true){

            $this->register($message='El mail ya está registrado en Base de Datos.');
        }

        else{

            try{
                $account = new Account($email, $password, "student");

                $this->daoAccount->add($account);

                header("Location: showList");

            }
            catch(PDOException $p){

            }
        }

    }

    public function addAdmin($message=''){
        require_once("views/add-admin.php");
    }

    public function addStudent($message=''){
        require_once("views/add-student.php");
    }

    public function logOff(){
        unset($_SESSION['access_token']);
        
        unset($_SESSION['account']);
        
        unset($_SESSION['loginValidator']);

        session_destroy();
        
        unset($_SESSION['loginValidator']); 

        header("location: " . FRONT_ROOT . "index.php");
    }

    public function viewAccount(){

        $student = $this->daoStudent->getStudentByEmailAPI($_SESSION['account']->getEmail());
        if(isset($_SESSION['account'])){            
            include ROOT . VIEWS_PATH . "view-account.php";
        }else{
            header("Location: login");
        }
    }
    
    public function logIn(){
        require_once("views/login.php");
    }

    public function editAccount(){
        include ROOT . VIEWS_PATH . "update-account.php";
    }

    public function update($password, $rPassword){ //NO ANDA

        $daoStudent = $this->daoStudent::getInstance();

        $accountOriginal = $_SESSION['account'];
        
        $_SESSION['updateValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['updateValidator']['password'] == 'is-invalid'){
            $this->editAccount();
        }
        else{
            unset($_SESSION['updateValidator']);

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
    
    public function showList(){

        $arrayAccount = $this->daoAccount->getAll();

        require_once(VIEWS_PATH."list-account.php");
    }

    public function showListCompany(){

        require_once(VIEWS_PATH."view-company.php");
    }

    /*public function showListStudent(){

        $arrayAccount = $this->daoAccount->getAll();

        require_once(VIEWS_PATH."list-account.php");
    }*/


}