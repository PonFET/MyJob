<?php
namespace Controllers;

use Daos\DaoAccounts as DaoAccounts;
use models\Account as Account;
use Daos\DaoStudents as DaoStudents;
use models\Student as Student;
use Daos\DaoCompanies as DaoCompanies;
use models\Company as Company;
use models\Career as Career;
use Daos\DaoCareers as DAOCareer;
use DateTime;
use PHPMailer\email as email;
use PDOException;

class AccountController{
    private $daoAccount;
    private $daoStudent; 
    private $daoCompany;  
    private $daoCareer;
    private $email;
      

    function __construct(){
        $this->daoAccount = new DaoAccounts();
        $this->daoStudent = new DaoStudents(); 
        $this->daoCompany = new DaoCompanies(); 
        $this->daoCareer = new DAOCareer();
        $this->email = new email();
        
    }

    public function verify($email, $password) 
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

            else
            {
                $this->login('Contraseña errónea!');
            }
        }
        else
        {
            $this->login('E-mail inválido!');
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

    public function create($password, $rPassword, $email, $privilegios){

        try{
            
            if($password == $rPassword){
                               
                $account = new Account($email, $password, $privilegios);
      
                $this->daoAccount->add($account);

                $aux = $this->daoAccount->getByEmail($email);

                $aux->setPrivilegios('student');
                
                $_SESSION["account"] = $aux;
                
                header("Location: viewAccount");                

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

                $this->email->sendNewCompany($company);
                
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

    public function adminStudentPreview($email, $message='')
    {
        if($this->daoAccount->exist($email) == true){
            
            $message='El mail ya está registrado en Base de Datos.';
            $this->addStudent($message);
        }
        else if($this->daoStudent->existAPI($email) == true){

            $message='El mail no está registrado en API.';
            $this->addStudent($message);
            
        }

        else
        {
        
            $student = $this->daoStudent->getStudentByEmailAPI($email);

            $career = $this->daoCareer->getCareerByIdAPI($student->getCareerId());
        
            require_once(VIEWS_PATH . 'add-student-admin.php');
        }
    }

    public function createStudentByA($password, $rPassword, $email, $privilegios){
        
        if($password == $rPassword)
        {
        
            $daoStudent = $this->daoStudent::GetInstance();       

            try{
                $account = new Account($email, $password, 2);

                $this->daoAccount->add($account);

                header("Location: showList");

            }
            catch(PDOException $p){

            }
        }

        else
        {
            $this->adminStudentPreview($email, 'Las contraseñas no coinciden!');
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
                
        unset($_SESSION['account']);

        session_destroy();

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
    
    public function logIn($message=''){
        require_once("views/login.php");
    }

    public function editAccount($message=''){
        include ROOT . VIEWS_PATH . "update-account.php";
    }   

    public function showUpdateCompany($message='')
    {
        $account = $this->daoAccount->getByEmail($_SESSION['account']->getEmail());
        $company = $this->daoCompany->getByEmail($_SESSION['account']->getEmail());

        require_once(VIEWS_PATH . 'update-company-account.php');
    }

    public function updateCompanyAccount($companyName, $location, $description, $phoneNumber, $cuit, $email, $aPassword, $nPassword, $rNPassword, $companyId)
    {
        if($aPassword == $_SESSION['account']->getPassword())
        {
            if($nPassword == $rNPassword)
            {
                $account = new Account($email, $nPassword, 3);
                $account->setId($_SESSION['account']->getId());

                $this->daoAccount->update($account);
                
                $company = new Company($companyName, $location, $description, $email, $phoneNumber, $cuit);
                $company->setCompanyId($companyId);

                $this->daoCompany->update($company);

                $account->setPrivilegios('company');

                unset($_SESSION['account']);

                $_SESSION['account'] = $account;
                
                header("Location: viewCompany");
            }

            else
            {
                $this->showUpdateCompany('Las contraseñas nuevas no coinciden.');
            }
        }

        else
        {
            $this->showUpdateCompany('La contraseña actual no coincide con la ingresada.');
        }
    }

    public function updateStudentAccount($password, $rPassword)
    {
        if($password == $rPassword)
        {
            $aux = new Account();
            $aux = $_SESSION['account'];
            $aux->setPassword($password);

            $this->daoAccount->update($aux);

            header("Location: viewAccount");
        }

        else
        {
            $this->editAccount('Las contraseñas no coinciden!');
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