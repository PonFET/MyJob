<?php
    namespace Daos;

    use \Exception as Exception;
    use Daos\Idao as Idao;
    use Daos\Connection as Connection;
    use models\Company as Company;


    class DaoCompanies implements Idao
    {
        private $companyList = array();
        private $tableName = "companies";
        
        public function __construct()    
        {
            
        }


        
        public function add($company)
        {
            if($company instanceof Company){
                try{                    
                    $sql = 'INSERT into companies (companyId, companyName, location, description, email, phoneNumber, cuit) 
                    values (:companyId, :companyName, :location, :description, :email, :phoneNumber, :cuit);';
    
                    $parameters['companyId'] = $company->getCompanyId();
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
                $sql = "SELECT exists ( SELECT * from companies where email = :email);";
    
                $this->connection = connection::GetInstance();
    
                $result = $this->connection->Execute($sql);
    
                $rta = ($result[0][0] != 1)? false : true;
    
                return $rta;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }


        public function getByEmail($email){
            try{
                $sql = "SELECT * from companies where email = :email;";
    
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


        public function getById($companyId){
            try{
                $sql = "SELECT * from companies where companyId = :companyId;";
    
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


        public function delete(Company $company)
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

        public function mapeo($value){
   
            $company = new Company();

            $company->setCompanyId($value["companyId"]);
            $company->setCompanyName($value["companyName"]);
            $company->setLocation($value["location"]);
            $company->setDescription($value["description"]);
            $company->setEmail($value["email"]);
            $company->setPhoneNumber($value["phoneNumber"]);
            $company->setCuit($value['cuit']);
    
            return $company;
        }


        
    }

?>