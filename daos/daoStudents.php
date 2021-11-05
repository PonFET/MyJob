<?php

namespace daos;

require_once("config/autoload.php");

use PDOExceptions;
use models\Student as Student;
use models\Account;
use daos\connection as connection;

class DaoStudents implements Idao{
    private $connection;
    private static $instance = null;

    private function __construct(){
    }

    public static function GetInstance(){
        if(self::$instance == null){
            self::$instance = new DaoStudents();
        }
        return self::$instance;
    }

    /* este metodo no va a ser utilizado ya que no podemos modificar de la api
    public function update($student){
        try{

            $this->connection = connection::GetInstance();

            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }*/

    public function exist($email){
        try{
            $sql = "SELECT exists ( SELECT * from students where email = :email);";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $rta = ($result[0][0] != 1)? false : true;

            return $rta;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    //verifica si el mail ingresado esta en la API, quizas la rta tenga que devolver la rta contraria.
    public function existAPI($email){
        try{
            
            $rta = true;
            
            $listStudent = $this->studentsFromApi();
            foreach($listStudent as $student){
                if($email == $student->getEmail()){
                    $rta = false;
                }
            }

            return $rta;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    // Usar DaoStudents como recolector de la API
    public function updateFromApi(){
        $listStudent = $this->studentsFromApi();
        foreach($listStudent as $student){
            if(!($this->exist($student->getEmail()))){
                $this->add($student);
            }
        }
    }
    
    //Devuelve un arreglo de Students que vienen de la API
    private function studentsFromApi(){
        $opciones = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"));
        $contexto = stream_context_create($opciones);
        $api_url = "https://utn-students-api.herokuapp.com/api/Student";
        $api_json = file_get_contents($api_url, false, $contexto);
        $api_array = ($api_json) ? json_decode($api_json, true) : array();

        $listStudent = array();

        foreach ($api_array as $value) {
            $student = new Student();

            $student->setStudentId($value["studentId"]);
            $student->setCareerId($value["careerId"]);
            $student->setFirstName($value["firstName"]);
            $student->setLastName($value["lastName"]);
            $student->setDni($value["dni"]);
            $student->setFileNumber($value["fileNumber"]);
            $student->setGender($value["gender"]);
            $student->setBirthDate($value["birthDate"]);
            $student->setEmail($value["email"]);
            $student->setPhoneNumber($value["phoneNumber"]);
            $student->setActive($value["active"]);

            array_push($listStudent, $student);
        }

        return $listStudent;
    }

    public function getByIdStudent($studentId){
        try{
            $sql = "SELECT * from students where studentId = :studentId;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    
    //este id seria de la cuenta, ya que en la bdConstruct students tiene un foreign key del id de cuentas
    public function getById(int $id){
        try{
            $sql = "SELECT * from students where id = :id;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getByDni($dni){
        try{
            $sql = "SELECT * from students where dni = :dni;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    
    public function getByEmail($email){
        try{
            $sql = "SELECT * from students where email = :email;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getAll(){
        try{
            $sql = "SELECT * from students;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);
        
            return $array;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    //supongo que aca hay que poner el if para hacer la comparacion con los mails y encontrar el student
    public function add($account){

        if(($account instanceof Account) && ($account->getStudent() instanceof Student)){
            try{
                // entran todos los atributos que se presentan en el bdConstruct de students
                $sql = "INSERT into students (id, studentId, careerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, password, phoneNumber, active) 
                values (:id, :studentId, :careerId, :firstName, :lastName, :dni, :fileNumber, :gender, :birthDate, :email, :password, :phoneNumber, :active);";

                $parameters['id'] = $account->getId();
                // posiblemente borrar el toArray ya que el studentFromApi nos trae un arreglo del student
                $parameters = $this->toArray($account->getStudent());

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($sql, $parameters);
            }catch (Exception $ex){
                throw $ex;
            }
        }
    }

    //posiblemente no ande
    public function toArray($object){
        $parameters = array();

        if($object instanceof Student){
            
            $parameters['studentId'] = $object->getStudentId();
            $parameters['careerId'] = $object->getCareerId();
            $parameters['firstName'] = $object->getFirstName();
            $parameters['lastName'] = $object->getLastName();
            $parameters['dni'] = $object->getDni();
            $parameters['fileNumber'] = $object->getFileNumber();
            $parameters['gender'] = $object->getGender();
            $parameters['birthDate'] = $object->getBirthDate();
            $parameters['email'] = $object->getEmail();
            $parameters['password'] = $object->getPassword();
            $parameters['phoneNumber'] = $object->getPhoneNumber();
            $parameters['active'] = $object->getActive();
            
        }
        return $parameters;
    }
    
    public function mapeo($value){
   
        $student = new Student();
        $student->setStudentId($value["studentId"]);
        $student->setCareerId($value["careerId"]);
        $student->setFirstName($value["firstName"]);
        $student->setLastName($value["lastName"]);
        $student->setDni($value["dni"]);
        $student->setFileNumber($value["fileNumber"]);
        $student->setGender($value["gender"]);
        $student->setBirthDate($value["birthDate"]);
        $student->setEmail($value["email"]);
        $student->setPassword($value["password"]);
        $student->setPhoneNumber($value["phoneNumber"]);
        $student->setActive($value["active"]);

        return $student;
    }
}
?>