<?php
    namespace controllers;

    use daos\daoJobOffers as DAOJobOffers;
    use daos\daoJobPosition as DAOJobPositions;
    use models\jobPosition as JobPosition;
    use models\jobOffer as JobOffer;

    class jobOfferController
    {
        private $daoJobOffers;
        private $daoJobPositions;

        public function __construct()
        {
            $this->daoJobOffers = new DAOJobOffers();
            $this->daoJobPositions = new DAOJobPositions();
        }



        public function showOfferView()
        {
            session_start();

            $offerList = $this->daoJobOffers->getAllOffers();
            $offXposList = $this->daoJobOffers->getAllOffersbyPosition();
            $positionList = $this->daoJobPositions->getAll();

            require_once(VIEWS_PATH . 'offer-list.php');
        }

        public function add($companyId, $offerDescription, $jobPositionIdArray) //Recibe desde la vista un array con los JobPosition que va a pedir la JobOffer.
        {
            $offer = new JobOffer();
            $offer->setCompanyId($companyId);
            $offer->setOfferDescription($offerDescription);

            $this->daoJobOffers->add($offer, $jobPositionIdArray);

            $this->showOfferView();
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

            $this->showOfferView();
        }

        public function studentPostulationAdd()
        {
            //Verificar primero si el alumno ya está postulado.
        }

        public function studentPostulationHistory($studentId)
        {
            
        }
    }