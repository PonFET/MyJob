<?php
namespace Controllers;

use Daos\DaoAccounts as DaoAccounts;
use models\Account as Account;
use Daos\DaoStudents as DaoStudents;
use models\Student as Student;
use Daos\DaoCompanies as DaoCompanies;
use models\Company as Company;
use PHPMailer\email as email;
use PDOException;

class AccountController{
    private $daoAccount;
    private $daoStudent; 
    private $daoCompany;  
    private $email;
      

    function __construct(){
        $this->daoAccount = new DaoAccounts();
        $this->daoStudent = new DaoStudents(); 
        $this->daoCompany = new DaoCompanies(); 
        $this->email = new email();
        
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
                
                if($accountAux->getPrivilegios() == 'admin')
                {
                    header("Location: showList");
                }

                elseif($accountAux->getPrivilegios() == 'student')
                {
                    header("Location: viewAccount");
                }

                elseif($accountAux->getPrivilegios() == 'company')
                {
                    header("Location: viewCompany");
                }
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

    public function createCompany($companyName, $location, $description, $phoneNumber, $cuit, $email, $password, $rPassword, $privilegios){

        try{
            if($this->daoCompany->exist($email) == true){

                $this->register($message='El mail ya está registrado en Base de Datos.');

            }

            elseif($password == $rPassword){
                               
                $account = new Account($email, $password, $privilegios);
      
                $this->daoAccount->add($account);

                $company = new Company($companyName, $location, $description, $email, $phoneNumber, $cuit);

                $this->daoCompany->add($company);

                session_start();

                $_SESSION["account"] = $this->daoAccount->getByEmail($email);
                
                header("Location: viewCompany");

            }
            else{

                //la contraseña no coincide
                $this->register($message='La contraseña no coincide.');

            }
        }

        catch(PDOException $p){
        }

    }

    /// Es identico a los de arriba, solo que no se inicia sesion cuando se crea la cuenta ya que Admin los crea ///

    public function createAdminByA($email, $password){

        if($this->daoAccount->exist($email) == true){

            $this->addAdmin($message='El mail ya está registrado en Base de Datos.');
        }

        else{

            try{
                $account = new Account($email, $password, 1);

                $this->daoAccount->add($account);

                header("Location: showList");

            }
            catch(PDOException $p){

            }
        }

    }

    public function createStudentByA($email, $password){
        $daoStudent = $this->daoStudent::GetInstance();

        if($this->daoAccount->exist($email) == true){
            
            $message='El mail ya está registrado en Base de Datos.';
            $this->addStudent($message);
        }
        else if($this->daoStudent->existAPI($email) == true){

            $message='El mail no está registrado en API.';
            $this->addStudent($message);
            
        }

        else{

            try{
                $account = new Account($email, $password, 2);

                $this->daoAccount->add($account);

                header("Location: showList");

            }
            catch(PDOException $p){

            }
        }
    }
    
    public function createCompanyByA($companyName, $location, $description, $phoneNumber, $cuit, $email, $password){

        if($this->daoAccount->exist($email) == true){

            $this->addCompany($message='El mail ya está registrado en Base de Datos.');
        }

        else{

            try{
                $account = new Account($email, $password, 3);

                $this->daoAccount->add($account);

                $company = new Company($companyName, $location, $description, $email, $phoneNumber, $cuit);

                $this->daoCompany->add($company);

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

        $message = $message;
        require_once("views/add-student.php");
    }
    
    public function addCompany($message=''){
        require_once("views/add-company.php");
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

    public function viewCompany()
    {
        $company = $this->daoCompany->getByEmail($_SESSION['account']->getEmail());

        require_once (VIEWS_PATH . "view-company.php");
    }
    
    public function showList(){

        $arrayAccount = $this->daoAccount->getAll();

        require_once(VIEWS_PATH."list-account.php");
    }
}