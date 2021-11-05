<?php
    namespace DAOS;

    use \Exception as Exception;
    use DAOS\Idao as Idao;
    use DAOS\Connection as Connection;
    use Models\jobOffer as JobOffer;
    use Models\Account as Account;
    use models\Student;

class daoJobOffers
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
                $query = 'INSERT INTO' . $this->tableName . ' (companyId, offerDescription) VALUES (:companyId, :offerDescription);';

                $parameters['companyId'] = $jobOffer->getCompanyId();
                $parameters['offerDescription'] = $jobOffer->getOfferDescription();

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
            
            
            foreach ($jobOffer->getArrayJobPos() as $jobPositionId) //Hago un registro en OffersXPosition por cada jobPosition en el array
            {
                try 
                {
                    $query = 'INSERT INTO offersxposition (offerId, jobPositionId) VALUES (:offerId, :jobPositionId);';

                    $parameters['offerId'] = $resultSet;
                    $parameters['jobPositionId'] = $jobPositionId;

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }

                catch (Exception $ex)
                {
                    throw $ex;
                }
            }
            //hacer un solo try/catch
        }


        public function update(JobOffer $offer)
        //PositionChange es una variable donde TRUE significa que las JobPosition hay que updatearlas, si es FALSE son las mismas y no hay que modificar
        {
            try
            {
                $query = "UPDATE " . $this->tableName . " SET companyId=:companyId, offerDescription=:offerDescription WHERE offerId=:id;";

                $parameters["companyId"] = $offer->getCompanyId();
                $parameters["offerDescription"] = $offer->getOfferDescription();
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

                    array_push($this->jobOfferList, $aux);
                }

                return $this->jobOfferList;
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        // Implementación solicitada en segunda entrega, un estudiante solamente podía tener una sola postulación.
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


        public function addPostulation(Account $account, JobOffer $jobOffer) //Ta mal.
        {
            try
            {
                $query = "INSERT INTO offersxposition (offerId, accountId) VALUES (:studentId, :offerId);";

                $parameters["studentId"] = $account->getId();
                $parameters["offerId"] = $jobOffer->getOfferId();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }

            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        public function getAllOffersbyPosition()
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

                $query = 'SELECT * FROM jobxacc WHERE accountId=' . $account->getId() . ';';
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $aux = $this->parseToObject($fila);

                    array_push($this->jobOfferList, $aux);
                }

                return $this->jobOfferList;
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
        
            return $jobO;
        }
        
    }
?>