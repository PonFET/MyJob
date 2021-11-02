<?php
    namespace DAOS;

    use \Exception as Exception;
    use DAOS\Idao as Idao;
    use DAOS\Connection as Connection;
    use Models\Company as Company;


    class daoCompanies implements Idao
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

               
        /* Posible funcion para agregar empresas, en tal caso crear el enabled(activar) en este archivo junto a los private y agregarlo como parametro en el add.
            Tambien tendriamos que revisar cuando relacionar con empresas con enabled en 0(desactivado) o en 1(activado).
            
        public function addUp($companyId){
            $value =0;

            try
            {
                $parameters['companyId'] = $companyId;
                $sql = "UPDATE companies set " . DaoCompanies::COLUMN_ENABLED . " = 0 where companyId= $companyId";  
                
                $this->connection=Connection::getInstance();
                $value = $this->connection->ExecuteNonQuery($sql,$parameters);
            }
                catch(PDOException $ex){
                throw $ex;
            }
            return $value;
        }
*/

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