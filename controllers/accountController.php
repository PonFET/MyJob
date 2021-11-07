<?php
namespace Controllers;

use Daos\DaoAccounts as DaoAccounts;
use models\Account as Account;
use Daos\DaoStudents as DaoStudents;
use models\Student as Student;
use PDOException;



class AccountController{
    private $daoAccount;
    private $daoStudent;  
      

    function __construct(){
        $this->daoAccount = daoAccounts::GetInstance();
        $this->daoStudent = new DaoStudents(); 
        
    }

    public function verify($email='', $password='')
    {
        //$this->daoStudent->updateFromApi();
        if($this->daoAccount->exist($email))
        {
            $accountAux = new Account();
            $accountAux = $this->daoAccount->getByEmail($email);

            if($accountAux->getPassword() == $password)
            {
                session_start();
                $_SESSION["account"] = $accountAux;

                require_once(VIEWS_PATH . "offer-list.php");
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

    // Creo que no es necesario enviarle todos los parametros de Student, ya que este obtiene todos sus datos desde la API, recibiendo el email
    // podemos comparar con la API para saber cual student tiene el mismo email, si no existe deberiamos devolverlo al register()
    // Si hacemos esto modificar el metodo.
    public function create($email, $password, $rPassword){        

        if($password == $rPassword)
        {

            if(!$this->daoStudent->exist($email))
            {
                $studentAux = new Student();
                $studentAux = $this->daoStudent->getStudentByEmailAPI($email);
                var_dump($studentAux);
                $account = new Account($email, $password, $privilege='student', $studentAux->getStudentId());

                try
                {                    
                    $this->daoAccount->add($account);
                    session_start();
                    $_SESSION['account'] = $account;
                    require_once "views/offer-list.php";
                }
                
                catch(\Exception $ex)
                {
                    throw $ex;
                }
            }
            
            else
            {
                //mail ya registrado
                $this->register($message='El mail ya está registrado.');
            }
        }
        
        else
        {
            //la contraseña no coincide
            $this->register($message='Las contraseñas no coinciden.');
        }
    }
    

    // Es identico al de arriba, solo que no se inicia sesion cuando se crea la cuenta
    public function createStudent($email, $password, $rPassword){
        $daoStudent = $daoStudents::GetInstance();

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

        //$loginController = new LoginController();
        //$loginController->init();
        //header
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