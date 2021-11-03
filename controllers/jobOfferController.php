<?php
    namespace controllers;

    use daos\daoJobOffers as DAOJobOffers;
    use daos\daoJobPosition as DAOJobPositions;
    use models\jobPosition as JobPosition;
    use models\Account as Account;
    use models\jobOffer as JobOffer;

    class jobOfferController
    {
        private $daoJobOffers;
        private $daoJobPositions;

        public function __construct()
        {
            $this->daoJobOffers = new DAOJobOffers();
            $this->daoJobPositions = new DAOJobPositions(); //Un DAO llama a otro DAO si precisa info.
        }



        public function showOfferView($message)
        {
            session_start();

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

        public function studentPostulationAdd($studentId, $jobOfferId)
        {
            //Verificar primero si el alumno ya está postulado.
            $accountAux = new Account();
            $jobOfferAux = new JobOffer();
            $accountAux->setStudentId($studentId);
            $jobOfferAux->setOfferId($jobOfferId);

            $exists = 0;

            $exists = $this->daoJobOffers->getStudentsByOffers($accountAux);

            if($exists != 0) //El método del DAO es un COUNT(), si el estudiante ya está postulado devuelve un 1, de lo contrario un 0.
            {
                $this->showOfferView($message = 'El estudiante ya está postulado a una oferta!');
            }

            else //Si no está postulado, se carga en la tabla intermedia.
            {
                $this->daoJobOffers->addPostulation($accountAux, $jobOfferAux);
                $this->showOfferView($message = 'Postulación exitosa!');
            }
        }

        public function studentPostulationHistory($studentId)
        {
            
        }
    }