<?php

namespace Daos;

use Daos\Connection as Connection;
use models\Account as Account;
use Daos\DaoStudents as DaoStudents;
use PDOException;

class DaoAccounts implements Idao{
    private $connection;
    private static $instance = null;

    public function __construct(){
    }

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance = new DaoAccounts();

        return self::$instance;
    }

    public function add($account){
        if($account instanceof Account){
            try{
                $sql = "INSERT into accounts (email, password, privilegios) values (:email, :password, :privilegios);";
                $parameters['email'] =  $account->getEmail();
                $parameters['password'] =  $account->getPassword();
                $parameters['privilegios'] =  $account->getPrivilegios();
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($sql,$parameters);

                //el id se genera en la base de datos, por eso tengo que pedir nuevamente el objeto.
                $object = $this->getByEmail($account->getEmail());

                $account->setId($object->getId());
            
                $daoStudent = DaoStudents::GetInstance();

                $daoStudent->add($account);

            }
            catch(PDOException $ex){
                throw $ex;
            }
        }
    }

    public function getByEmail($email){
        try{
            $sql = "SELECT a.*, p.privilegeName FROM accounts a LEFT JOIN privileges p ON a.privilegeId = p.privilegeId WHERE a.email = :email;";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();
            
            $resultSet = $this->connection->Execute($sql, $parameters);

            var_dump($resultSet);

            $object = $this->mapeo($resultSet);            

            return $object;
        }
        catch (\Exception $ex){
            throw $ex;
        }
    }

    public function mapeo($value)
    {
        $account = new Account();

        $account->setId($value[0]['accountId']);
        $account->setEmail($value[0]['email']);
        $account->setPassword($value[0]['password']);
        $account->setStudentId($value[0]['studentId']);
        $account->setPrivilegios($value[0]['privilegeName']); 

        return $account;
    }

    public function getById($id){ 
        try{
            $sql = " SELECT * from accounts where id = :id";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $object = $this->mapeo($result);            

            return $object;
        }
        catch (\Exception $ex){
            throw $ex;
        }
    }

    public function exist($email){
        try{
            $sql = "SELECT * from accounts where email=:email;";
            
            $parameters['email'] = $email;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($sql, $parameters);

            if($result)
            {
                return true;
            }

            else return false;
            
        }

        catch(\Exception $ex){
            throw $ex;
        }
    }

    public function update($account){ //sacar perfiles
        if($account instanceof Account){
            if($this->exist($account->getEmail())){
                try{
                    $sql = "UPDATE accounts set email = :email, password = :password where id = :id";
                    $parameters['email'] = $account->getEmail();
                    $parameters['password'] = $account->getPassword();

                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
    
                    $daoProfile = DaoAccounts::GetInstance();
                    $daoProfile->update($cuenta->getProfile());
                }
                catch (Exception $ex) {
                    throw $ex;
                }
            }
        }
    }

    //posiblemente no ande
    public function toArray($object){
        $parameters = array();

        if($object instanceof Account){
            
            $parameters['email'] = $object->getEmail();
            $parameters['password'] = $object->getPassword();
            $parameters['privilegios'] = $object->getPrivilegios();
        }
        return $parameters;
    }
    
    public function getAll(){
        $sql = "SELECT * FROM accounts";
        $accountList = array();
        
        try
        {
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            
            foreach ($resultSet as $row)
            {                    
                $account = new Account();
                $account->setId($row["accountId"]);
                $account->setEmail($row["email"]);
                $account->setPassword($row["password"]);
                $account->setStudentId($row["studentId"]);
                $account->setPrivilegios($row["privilegeId"]);
                array_push($accountList,$account);
            }  
        
        }
        
        catch (PDOException $ex)
        { 
            throw $ex; 
        }

        return $accountList;
    }

}
?>