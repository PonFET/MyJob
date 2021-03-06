<?php

namespace Daos;


use PDOExceptions;
use models\JobPosition as jobPosition;
use Daos\Connection as connection;

class DaoJobPositions{
    private $connection;
    private static $instance = null;

    public function __construct(){
    }

    public static function GetInstance(){
        if(self::$instance == null){
            self::$instance = new JobPositions();
        }
        return self::$instance;
    }

    //Devuelve un arreglo de Students que vienen de la API
    private function jobPositionsFromApi(){
        // averiguar que hago con los atributos password y privilegios
        $opciones = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"));
        $contexto = stream_context_create($opciones);
        $api_url = "https://utn-students-api.herokuapp.com/api/JobPosition";
        $api_json = file_get_contents($api_url, false, $contexto);
        $api_array = ($api_json) ? json_decode($api_json, true) : array();

        $listJobPosition = array();

        foreach ($api_array as $value) {
            $jobPosition = new JobPosition();

            $jobPosition->setJobPositionId($value["jobPositionId"]);
            $jobPosition->setCareerId($value["careerId"]);
            $jobPosition->setDescription($value["description"]);

            array_push($listJobPosition, $jobPosition);
        }

        return $listJobPosition;
    }

    //NO USAR!!
    public function updateFromApi(){
        $listJobPosition = $this->jobPositionsFromApi();
        foreach($listJobPosition as $jobPosition){
            
                $this->add($jobPosition);
            
        }
    }

    public function getById($jobPositionId){
        try{
            $sql = "SELECT * from jobPosition where jobPositionId = :jobPositionId;";

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

    public function mapeo($value){
   
        $jobPosition = new JobPosition();
        $jobPosition->setJobPositionId($value[0]["jobPositionId"]);
        $jobPosition->setCareerId($value[0]["careerId"]);
        $jobPosition->setDescription($value[0]["description"]);

        return $jobPosition;
    }

    public function getAll(){
        try{
            $sql = "SELECT * from jobPosition;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = array();

            foreach($result as $row)
            {
                $jobPosition = new JobPosition();
                $jobPosition->setJobPositionId($row["jobPositionId"]);
                $jobPosition->setCareerId($row["careerId"]);
                $jobPosition->setDescription($row["description"]);
                
                array_push($array, $jobPosition);
            }
        
            return $array;
        }
        catch(\Exception $ex){
            throw $ex;
        }
    }

    public function add($jobPosition){

        if($jobPosition instanceof JobPosition){
            try{
                $sql = "INSERT into jobPosition (jobPositionId, careerId, description) 
                values ( :jobPositionId, :careerId, :description);";

                $parameters['jobPositionId'] = $jobPosition->getJobPositionId();
                $parameters['careerId'] = $jobPosition->getCareerId();
                $parameters['description'] = $jobPosition->getDescription();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($sql, $parameters);
            }catch (\Exception $ex){
                throw $ex;
            }
        }
    }

    //posiblemente no ande
    public function toArray($jobPosition, $type = 0){
        $parameters = array();

        if($jobPosition instanceof JobPosition){
            if($type == 0){
                $parameters['jobPositionId'] = $jobPosition->getById();
            }

            $parameters['jobPositionId'] = $jobPosition->getJobPositionId();
            $parameters['careerId'] = $jobPosition->getCareerId();
            $parameters['description'] = $jobPosition->getDescription();
            
        }
        return $parameters;
    }

}
?>