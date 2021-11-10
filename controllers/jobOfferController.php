<?php
    namespace Controllers;

    use Daos\DaoJobOffers as DAOJobOffers;
    use Exception;
    use Daos\DaoJobPositions as DAOJobPositions;       
    use Daos\DaoCompanies as DAOCompanies;
    use models\Account as Account;
    use models\jobOffer as JobOffer;

    class JobOfferController
    {
        private $daoJobOffers;
        private $daoJobPositions;
        private $daoCompanies;

        public function __construct()
        {
            $this->daoJobOffers = new DAOJobOffers();
            $this->daoCompanies = new DAOCompanies();
            $this->daoJobPositions = new DAOJobPositions();
        }



        public function showOfferView($message='')
        {
            $offerList = $this->daoJobOffers->getAllOffers();
            $offXposList = $this->daoJobOffers->getAllOffersbyPosition();
            $positionList = $this->daoJobPositions->getAll();   //Armar array de jobpositions desde DAO.

            require_once(VIEWS_PATH . 'offer-list.php');
        }

        public function add($companyId, $offerDescription, $jobPositionIdArray) //Recibe desde la vista un array con los JobPosition que va a pedir la JobOffer.
        {
            $offer = new JobOffer();
            $offer->setCompanyId($companyId);
            $offer->setOfferDescription($offerDescription);
            $offer->setArrayJobPos($jobPositionIdArray);

            $this->daoJobOffers->add($offer);

            $this->showOfferView($message = "");
        }
        
        public function ShowAddOfferView()
        {
            $positionList = $this->daoJobPositions->getAll();            
            $companiesList = $this->daoCompanies->getAll();

            require_once(VIEWS_PATH . 'add-offer.php');
        }

        public function ShowListActive()
        {
            $offerList = $this->daoJobOffers->getAllEnabledOffers();
            $companiesList = $this->daoCompanies->getAll();
            $positionList = $this->daoJobPositions->getAll();

            require_once(VIEWS_PATH . 'list-offer-enabled.php');
        }

        public function delete($offerId)
        {
            $offerList = $this->daoJobOffers->getAllOffers();
            $offer = new JobOffer();

            foreach ($offerList as $key)
            {
                if($key->getOfferId() == $offerId)
                {
                    $offer = $key;
                }
            }

            $this->daoJobOffers->delete($offer);

            $this->showOfferView($message = "");
        }

        public function studentPostulationAdd($studentId, $jobOfferId)
        {
            //Verificar primero si el alumno ya está postulado.
            $accountAux = new Account();
            $jobOfferAux = new JobOffer();
            $accountAux->setId($studentId);
            $jobOfferAux->setOfferId($jobOfferId);

            $this->daoJobOffers->addPostulation($accountAux, $jobOfferAux);
            $this->showOfferView($message = 'Postulación exitosa!');
            
        }

        public function studentPostulationHistory($accountId)
        {
            $accountAux = new Account();
            $accountAux->setId($accountId);


            $companiesList = $this->daoCompanies->getAll();
            $positionList = $this->daoJobPositions->getAll();
            $postulationList = $this->daoJobOffers->getAllOffersByStudent($accountAux);

            require_once(VIEWS_PATH . "student-history-list");
        }

        public function update($offerId, $offerDescription)
        {
            $jobOfferAux = new JobOffer();
            $jobOfferAux->setOfferId($offerId);
            $jobOfferAux->setOfferDescription($offerDescription);

            try
            {
                $this->daoJobOffers->update($jobOfferAux);
            }

            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }