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
                $this->connection = connection::GetInstance();

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
            $sql = " SELECT * from accounts where email = :email";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($sql);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        }
        catch (Exception $ex){
            throw $ex;
        }
    }

    public function mapeo($value){

        $daoStudent = DaoStudents::GetInstance();
   
        $account = new Account();

        $account->setId($value["id"]);
        $account->setEmail($value["email"]);
        $account->setPassword($value["password"]);
        $account->setPrivilegios($value["privilegios"]);
        $account->setStudent($daoStudent->getById($account->getId()));

        return $account;
    }

    public function getById($id){
        try{
            $sql = " SELECT * from accounts where id = :id";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        }
        catch (Exception $ex){
            throw $ex;
        }
    }

    public function exist($email){
        try{
            $sql = "SELECT exists ( SELECT * from accounts where email = :email);";

            $this->connection = connection::GetInstance();

            $result = $this->Execute($sql);

            $rta = ($result[0][0] != 1)? false : true;

            return $rta;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function update($account){
        if($account instanceof Account){
            if($this->exist($account->getEmail())){
                try{
                    $sql = "UPDATE accounts set email = :email, password = :password where id = :id";
                    $parameters['email'] = $account->getEmail();
                    $parameters['password'] = $account->getPassword();

                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
    
                    $daoProfile = DaoProfiles::GetInstance();
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
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            
            if(!empty($resultSet)){ 
                foreach ($resultSet as $row) {
                    $aux = $this->mapeo($row);
                    array_push($accountList,$aux);
                }  
            }
            } catch (PDOException $ex) { 
                throw $ex; 
            } 
        return $accountList;
    }

}
?>