<?php
    namespace DAOS;

    use \Exception as Exception;
    use DAOS\Idao as Idao;
    use DAOS\Connection as Connection;
    use Models\jobOffer as JobOffer;

    class daoJobOffers
    {
        private $jobOfferList = array();
        private $tableName = 'jobOffers';

        public function __construct()
        {
            
        }


        public function add(jobOffer $jobOffer, $jobPositionIdArray)
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

            
            foreach ($jobPositionIdArray as $jobPositionId) //Hago un registro en OffersXPosition por cada jobPosition en el array
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
            
        }

        public function getAllOffers()
        {
            try
            {
                $jobOfferList = array();

                $query = 'SELECT * FROM ' . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $fila)
                {
                    $jobOffer = new JobOffer();
                    $jobOffer->setOfferId($fila['offerId']);
                    $jobOffer->setCompanyId($fila['companyId']);
                    $jobOffer->setOfferDescription($fila['offerDescription']);

                    array_push($jobOfferList, $jobOffer);
                }

                return $jobOfferList;
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
        
    }
?>