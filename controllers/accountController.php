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
    private $DaoCompany;  
      

    function __construct(){
        $this->daoAccount = daoAccounts::GetInstance();
        $this->daoStudent = new DaoStudents(); 
        $this->DaoCompany = new DaoCompanies(); 
        
    }

    public function verify($email='', $password='')
    {        
        if($this->daoAccount->exist($email))
        {
            $accountAux = new Account();
            $accountAux = $this->daoAccount->getByEmail($email);

            if($accountAux->getPassword() == $password)
            {
                if(!isset($_SESSION))
                {
                    session_start();
                }
                $_SESSION["account"] = $accountAux;

                header("location:".FRONT_ROOT."Student/viewOffer");
            }
        }
        else
        {
            //no existe   
            require_once(VIEWS_PATH."login.php");
        }
    }

    public function register($message=''){
        require_once "views/signup.php";
    }

    public function create($email, $password, $rPassword, $privilegios){        
        
        $studentList = $daoStudent->getAll();
        $companyList = $DaoCompany->getAll();

        try{
            if($password == $rPassword)
            {
                if($privilegios == "student"){

                    if($this->daoStudent->exist($email) == true){

                        $this->register($message='El mail ya está registrado en Base de Datos.');
                    }
                    else if($this->daoStudent->existAPI($email) == true){

                        $this->register($message='El mail no está registrado en API.');
                        
                    }
                    else{
                        
                            $_SESSION["email"] = $email;
                            $_SESSION["password"] = $password;

                            if($privilegios == "student"){
                                header("location:".FRONT_ROOT."Student/viewOffer");
                            }else{
                                header("location:".FRONT_ROOT."Company/ShowAddView");
                            }
                            
                          /* Esto estaba antes cuando solo era student.
                          $studentAux = new Student();                
                            $studentAux = $this->daoStudent->getStudentByEmailAPI($email);                 
                            $account = new Account($email, $password, $privilegios='student', $studentAux->getStudentId());
                  
                            $this->daoAccount->add($account);
                            session_start();
                            $_SESSION['account'] = $account;
                            require_once "views/offer-list.php";*/

                    }            
                }
            }
            
            else{
                //la contraseña no coincide
                $this->register($message='Las contraseñas no coinciden.');
            }

        }
        catch(PDOException $p){
        }
    }
    

    // Es identico al de arriba, solo que no se inicia sesion cuando se crea la cuenta
    public function createStudent($email, $password, $rPassword){
        $daoStudent = $this->daoStudent::GetInstance();

        // Supongo que esta linea hace la comparacion de los emails que hay en bases de datos
        $_SESSION['registerValidator']['email'] = ($this->daoStudent->exist($email)) ? 'is-invalid' : 'is-valid';

        // Aun no funciona
        $_SESSION['registerValidator']['emailAPI'] = ($this->daoStudent->existAPI($email)) ? 'is-valid' : 'is-invalid';
        
        $_SESSION['registerValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['registerValidator']['email'] == 'is-invalid'  || $_SESSION['registerValidator']['password'] == 'is-invalid' || $_SESSION['registerValidator']['emailAPI'] == 'is-valid'){
            $this->register();
        }
        else{
            unset($_SESSION['registerValidator']);

            $account = new Account(0, $email, $password, "student");

            $account->setStudent(new Student($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active));

            try{
                $this->daoAccount->add($account);

            }
            catch(PDOException $p){

            }
        }
    }

    public function createAdmin($email, $password, $rPassword){

        $_SESSION['registerValidator']['email'] = ($this->daoStudent->exist($email)) ? 'is-invalid' : 'is-valid';

        $_SESSION['registerValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['registerValidator']['email'] == 'is-invalid'  || $_SESSION['registerValidator']['password'] == 'is-invalid'){
            $this->addAdmin();
        }
        else{
            unset($_SESSION['registerValidator']);
            
            $account = new Account(0, $email, $password, "admin");

            try{
                $this->daoAccount->add($account);
            }
            catch(PDOException $p){
                
            }
        }

    }

    public function addAdmin(){
        require_once("views/add-admin.php");
    }

    public function addStudent(){
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

    public function update($password, $rPassword){

        $daoStudent = $daoStudent::getInstance();

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


}