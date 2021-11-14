<?php
    namespace Daos;

    use \Exception as Exception;
    use Daos\Idao as Idao;
    use Daos\Connection as Connection;
    use models\Company as Company;


    class DaoCompanies
    {
        private $companyList = array();
        private $tableName = "companies";
        
        public function __construct()    
        {
            
        }


        
        public function add(Company $company)
        {            
                try{                    
                    $sql = 'INSERT into companies (companyName, location, description, email, phoneNumber, cuit) 
                    values (:companyName, :location, :description, :email, :phoneNumber, :cuit);';    
                    
                    $parameters['companyName'] = $company->getCompanyName();
                    $parameters['location'] = $company->getLocation();
                    $parameters['description'] = $company->getDescription();
                    $parameters['email'] = $company->getEmail();
                    $parameters['phoneNumber'] = $company->getPhoneNumber();  
                    $parameters['cuit'] = $company->getCuit();
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($sql, $parameters);
                }catch (Exception $ex){
                    throw $ex;
                }
            
        }


        public function update(Company $company)
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET 
                        companyName=:companyName,
                        location=:location,
                        description=:description,
                        email=:email,
                        phoneNumber=:phoneNumber,
                        cuit=:cuit
                        WHERE companyId=:companyId;";

                $parameters["companyName"] = $company->getCompanyName();
                $parameters["location"] = $company->getLocation();
                $parameters["description"] = $company->getDescription();                
                $parameters["email"] = $company->getEmail();
                $parameters["phoneNumber"] = $company->getPhoneNumber();                
                $parameters['cuit'] = $company->getCuit();
                $parameters['companyId'] = $company->getCompanyId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        public function exist($email){
            try{

                $result = null;
                
                $query = "SELECT * FROM companies WHERE email=:email;";

                $parameters["email"] = $email;

                $this->connection = connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters);

                if($result != null)
                {
                    return true;
                }

                else return false;
            }

            catch(Exception $ex){
                throw $ex;
            }
        }


        public function getByEmail($email){
            try{
                $sql = "SELECT * from companies where email = :email;";

                $parameters['email'] = $email;
    
                $this->connection = connection::GetInstance();
    
                $value = $this->connection->Execute($sql, $parameters);
    
                $company = new Company();                

                $company->setCompanyId($value[0]["companyId"]);
                $company->setCompanyName($value[0]["companyName"]);
                $company->setLocation($value[0]["location"]);
                $company->setDescription($value[0]["description"]);
                $company->setEmail($value[0]["email"]);
                $company->setPhoneNumber($value[0]["phoneNumber"]);
                $company->setCuit($value[0]['cuit']);
    
                return $company;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }


        public function getById($companyId){
            try{
                $sql = "SELECT * from companies where companyId = :companyId;";

                $parameters["companyId"] = $companyId;
    
                $this->connection = connection::GetInstance();
    
                $result = $this->connection->Execute($sql, $parameters);
    
                $array = $this->mapeo($result);
    
                $object = !empty($array) ? $array[0] : [];
    
                return $object;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }


        public function getAll()
        {
            try{
                $sql = "SELECT * from companies;";
    
                $this->connection = connection::GetInstance();
    
                $result = $this->connection->Execute($sql);
    
                $array = $this->mapeo($result);               
            
                return $array;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }


        public function delete(Company $company) //Droppear de otras tablas vinculadas al id
        {
            try
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE (companyId='" . $company->getCompanyId() . "');";

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            
            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function mapeo($result)
        {
            $objectArray = array();            
   
            foreach($result as $value)
            {
                $company = new Company();

                $company->setCompanyId($value["companyId"]);
                $company->setCompanyName($value["companyName"]);
                $company->setLocation($value["location"]);
                $company->setDescription($value["description"]);
                $company->setEmail($value["email"]);
                $company->setPhoneNumber($value["phoneNumber"]);
                $company->setCuit($value['cuit']);

                array_push($objectArray, $company);
            }
    
            return $objectArray;
        }


        
    }

?>