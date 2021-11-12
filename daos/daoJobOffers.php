<?php
    namespace Daos;

    use \Exception as Exception;    
    use Daos\Connection as Connection;
    use models\jobOffer as JobOffer;
    use models\Account as Account;
    

    class DaoJobOffers
    {
        private $jobOfferList = array();
        private $tableName = 'jobOffers';

        public function __construct()
        {
            
        }


        public function add(jobOffer $jobOffer)
        {
            $resultSet = null;           
            try //Registro nuevo JobOffer
            {
                $query = 'INSERT INTO ' . $this->tableName . ' (companyId, offerDescription, startDate, endDate) VALUES (:companyId, :offerDescription, :startDate, :endDate);';

                $parameters['companyId'] = $jobOffer->getCompanyId();
                $parameters['offerDescription'] = $jobOffer->getOfferDescription();
                $parameters['startDate'] = $jobOffer->getStartDate();
                $parameters['endDate'] = $jobOffer->getEndDate();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }

            try //Tomo el ID para hacer el insert en la tabla OffersXPosition
            {                
                $query = 'SELECT LAST_INSERT_ID() FROM joboffers;';
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                
            }
            
            catch (Exception $ex)
            {
                throw $ex;
            }
            
            
            try //Hago un registro en OffersXPosition por cada jobPosition en el array
            {
                foreach ($jobOffer->getArrayJobPos() as $jobPositionId)
                {                    
                    $query = 'INSERT INTO offersxposition (offerId, jobPositionId) VALUES (:offerId, :jobPositionId);';

                    $parametersOffer['offerId'] = $resultSet[0][0];
                    $parametersOffer['jobPositionId'] = $jobPositionId;                    

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parametersOffer);
                }                
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
            //hacer un solo try/catch
        }


        public function update(JobOffer $offer)
        //PositionChange es una variable donde TRUE significa que las JobPosition hay que updatearlas, si es FALSE son las mismas y no hay que modificar
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET companyId=:companyId, offerDescription=:offerDescription, startDate=:startDate, endDate=:endDate WHERE offerId=:id;";

                $parameters["companyId"] = $offer->getCompanyId();
                $parameters["offerDescription"] = $offer->getOfferDescription();
                $parameters['startDate'] = $offer->getStartDate();
                $parameters['endDate'] = $offer->getEndDate();
                $parameters["id"] = $offer->getOfferId();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

                /*if($positionChange == true)
                {
                    $query = "DELETE FROM offersxposition WHERE (offerId='" . $offer->getOfferId() . "');"; //Borro todos los registros de ese OfferId

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query);

                    foreach ($offer->getArrayJobPos() as $jobPositionId) //Hago un registro en OffersXPosition por cada jobPosition en el array
                    {
                        $query = 'INSERT INTO offersxposition (offerId, jobPositionId) VALUES (:offerId, :jobPositionId);';

                        $parameters['offerId'] = $offer->getOfferId();
                        $parameters['jobPositionId'] = $jobPositionId;

                        $this->connection = Connection::GetInstance();
                        $this->connection->ExecuteNonQuery($query, $parameters);
                    }
                }
                */
            }

            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function delete(JobOffer $offer)
        {
            try
            {
                $query = 'DELETE FROM ' . $this->tableName . ' WHERE (offerId="' . $offer->getOfferId() . '");';

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);


                $query2 = 'DELETE FROM offersxposition WHERE (offerId="' . $offer->getOfferId() . '");';

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query2);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        public function getAllOffers()
        {
            try
            {
                $resultSet = 0;

                $query = 'SELECT * FROM ' . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $aux = $this->parseToObject($fila);

                    $queryPostion = 'SELECT jobPositionId FROM offersxposition WHERE offerId = ' . $aux->getOfferId() . ';';
                    $this->connection = Connection::GetInstance();
                    $positionArray = $this->connection->Execute($queryPostion);

                    $aux->setArrayJobPos($positionArray);

                    array_push($this->jobOfferList, $aux);
                }

                return $this->jobOfferList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAllEnabledOffers()
        {
            try
            {
                $resultSet = 0;

                $query = 'SELECT * FROM ' . $this->tableName . ' WHERE enable = 1;';
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $parsed = array();

                foreach($resultSet as $row)
                {
                    $offer = new JobOffer();

                    $offer->setOfferId($row['offerId']);
                    $offer->setCompanyId($row['companyId']);
                    $offer->setOfferDescription($row['offerDescription']);
                    $offer->setStartDate($row['startDate']);
                    $offer->setEndDate($row["endDate"]);

                    $queryPostion = 'SELECT jobPositionId FROM offersxposition WHERE offerId = ' . $offer->getOfferId() . ';';
                    $this->connection = Connection::GetInstance();
                    $positionArray = $this->connection->Execute($queryPostion);

                    $arrayAux = array();

                    foreach($positionArray as $posRow)
                    {
                        array_push($arrayAux, $posRow['jobPositionId']);
                    }

                    $offer->setArrayJobPos($arrayAux);

                    array_push($parsed, $offer);
                }

                return $parsed;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        // Implementación solicitada en segunda entrega de Metodología, un estudiante solamente podía tener una sola postulación.
        /*public function getStudentsByOffers(Account $account) 
        {
            $resultSet = 0;

            try
            {
                $query = "SELECT COUNT(studentId) as studentId FROM offersxposition WHERE studentId=" . $account->getStudentId() . ";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                return $resultSet;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }

        }
        */


        public function addPostulation(Account $account, JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO jobxacc (offerId, accountId) VALUES (:offerId, :accountId);";
                
                $parameters["offerId"] = $jobOffer->getOfferId();
                $parameters["accountId"] = $account->getId();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        public function getAllOffersbyPosition() //Cambiar a un Query que llame a todo junto
        {
            try
            {
                $offXpos = array();

                $query = 'SELECT * FROM offersxposition;';
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                return $resultSet;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        public function getAllOffersByStudent(Account $account)
        {
            try
            {
                $resultSet = 0;

                $query = 'SELECT off.offerId, off.companyId, off.offerDescription, off.startDate, off.endDate, off.enable FROM jobxacc jxa LEFT JOIN joboffers off ON jxa.offerId = off.offerId WHERE jxa.accountId=' . $account->getId() . ';';
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $parsed = array();

                foreach($resultSet as $row)
                {
                    $offer = new JobOffer();

                    $offer->setOfferId($row['offerId']);
                    $offer->setCompanyId($row['companyId']);
                    $offer->setOfferDescription($row['offerDescription']);
                    $offer->setStartDate($row['startDate']);
                    $offer->setEndDate($row['endDate']);

                    $queryPostion = 'SELECT jobPositionId FROM offersxposition WHERE offerId = ' . $offer->getOfferId() . ';';
                    $this->connection = Connection::GetInstance();
                    $positionArray = $this->connection->Execute($queryPostion);

                    $arrayAux = array();

                    foreach($positionArray as $posRow)
                    {
                        array_push($arrayAux, $posRow['jobPositionId']);
                    }

                    $offer->setArrayJobPos($arrayAux);

                    array_push($parsed, $offer);
                }

                return $parsed;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        public function parseToObject($value)
        {
            $jobO= new JobOffer(); 
            $jobO->setOfferId($value['offerId']); 
            $jobO->setCompanyId($value['companyId']); 
            $jobO->setOfferDescription($value['offerDescription']);
            $jobO->setStartDate($value['startDate']);
            $jobO->setEndDate($value['endDate']);
        
            return $jobO;
        }
        
    }
?>