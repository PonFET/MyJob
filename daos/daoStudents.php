<?php

namespace Daos;

use PDOExceptions;
use models\Student as Student;
use Daos\Connection as connection;
use Exception;

class DaoStudents implements Idao{
    private $connection;
    private $listStudent = array();
    private static $instance = null;

    public function __construct(){
    }

    public static function GetInstance(){
        if(self::$instance == null){
            self::$instance = new DaoStudents();
        }
        return self::$instance;
    }

    public function exist($email)
    {
        try
        {
            $result = null;
            
            $query = "SELECT * FROM students WHERE email=:email;";

            $parameters["email"] = $email;

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters);

            if($result != null)
            {
                return true;
            }

            else return false;
        }

        catch(Exception $ex)
        {
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
        catch(\Exception $ex){
            throw $ex;
        }
    }

    public function getStudentByEmailAPI($email){
        try{
            
            $studentAux = null;
            
            $listStudent = $this->studentsFromApi();
            foreach($listStudent as $student){
                if($email == $student->getEmail()){
                    $studentAux = $student;                    
                }                
            }

            return $studentAux;
        }
        catch(\Exception $ex){
            throw $ex;
        } 
    }

    // NO USAR!!
    public function updateFromApi(){
        $listStudent = $this->studentsFromApi();
        foreach($listStudent as $student)
        {                
            $this->add($student);
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
        catch(\Exception $ex){
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
        catch(\Exception $ex){
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
        catch(\Exception $ex){
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
        catch(\Exception $ex){
            throw $ex;
        }
    }


    public function getStudentsByAccount()
    {
        try
        {
            $query = "SELECT s.studentId,
                             s.careerId,
                             s.firstName,
                             s.lastName,
                             s.dni,
                             s.fileNumber,
                             s.gender,
                             s.birthDate,
                             s.email,
                             s.phoneNumber,
                             s.active,
                             a.accountId
                        FROM students s INNER JOIN accounts a ON s.email=a.email;";

            $this->connection = connection::GetInstance();
            $studentList = $this->connection->Execute($query);

            $array = array();

            foreach($studentList as $row)
            {
                $student = $this->mapeo($row);
                
                $arrayAux['accountId'] = $row['accountId'];
                $arrayAux['student'] = $student;

                array_push($array, $arrayAux);
            }

            return $array;
        }

        catch(Exception $ex)
        {
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
        catch(\Exception $ex){
            throw $ex;
        }
    }

    
    public function add(Student $student)
    {
        try
        {
            $sql = "INSERT into students (studentId, careerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, phoneNumber, active) 
            values (:studentId, :careerId, :firstName, :lastName, :dni, :fileNumber, :gender, :birthDate, :email, :phoneNumber, :active);";

            $parameters['studentId'] = $student->getStudentId();
            $parameters['careerId'] = $student->getCareerId();
            $parameters['firstName'] = $student->getFirstName();
            $parameters['lastName'] = $student->getLastName();
            $parameters['dni'] = $student->getDni();
            $parameters['fileNumber'] = $student->getFileNumber();
            $parameters['gender'] = $student->getGender();
            $parameters['birthDate'] = $student->getBirthDate();
            $parameters['email'] = $student->getEmail();
            $parameters['phoneNumber'] = $student->getPhoneNumber();
            $parameters['active'] = $student->getActive();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        
        catch(\Exception $ex)
        {
            throw $ex;
            
        }
        
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
        $student->setPhoneNumber($value["phoneNumber"]);
        $student->setActive($value["active"]);

        return $student;
    }
}
?>