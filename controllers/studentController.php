<?php
namespace Controllers;

use Daos\DaoStudents;
use models\Student as student;
use Daos\DaoCareers as DaoCareers;
use models\Career as Career;
use PDOException;

//El studentController no tendra mucha utilidad ya que accountController tendra la mayoria de sus metodos haciendo su trabajo.
//Aun asi lo dejaremos por ahora ya que podriamos crearle metodos que solo este pueda ejecutar.

class StudentController{
    private $daoStudent;
    private $daoCareer;  

    function __construct(){
        $this->daoStudent = daoStudents::getInstance();
        $this->daoCareer = new DaoCareers(); 
    }

    public function verificar($email = "", $password = ""){
        if($this->daoStudent->exist($email)){
            $student = $this->daoStudent->getByEmail($email);

            if($student->getPassword() == $password){
                $_SESSION["student"] = $student;
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

    public function addPassword($message=''){

        $email = $_SESSION["email"];
        $privilegios = $_SESSION["privilegios"];

        $student = $this->daoStudent->getStudentByEmailAPI($email);

        $career = $this->daoCareer->getCareerByIdAPI($student->getCareerId());        

        require_once(VIEWS_PATH . "add-student-user.php");
    }

    public function logOff(){
        unset($_SESSION['access_token']);
        
        unset($_SESSION['student']);
        
        unset($_SESSION['loginValidator']);

        session_destroy();

        $loginController = new LoginController();
        $loginController->init();
    }

    public function viewStudent(){
        if(isset($_SESSION['student'])){
            include ROOT . VIEWS_PATH . "nav-bar.php";
            include ROOT . VIEWS_PATH . "view-student.php";
        }else{
            require_once("views/login.php");
        }
    }

    public function edit(){
        include ROOT . VIEWS_PATH . "update-student.php";
    }

    public function update($email, $password, $rPassword){

        $daoStudent = $daoStudents::getInstance();

        $cuentaOriginal = $_SESSION['student'];

        
        $_SESSION['updateValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['updateValidator']['password'] == 'is-valid'){
            $this->edit();
        }
        else{
            unset($_SESSION['updateValidator']);

            $cuentaOriginal->setPassword($password);
            $cuentaOriginal->getStudent()->setEmail($email);

            try{
                $this->daoStudent->update($student);

                $_SESSION['student'] = $cuentaOriginal;

                $this->viewStudent();

            }
            catch(PDOException $p){

            }
        }
    }
}
?>