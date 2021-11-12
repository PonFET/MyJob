<?php
    namespace Controllers;

    use Daos\DaoJobOffers as DAOJobOffers;
    use Daos\DaoCareers as DAOCareers;
    use Exception;
    use Daos\DaoJobPositions as DAOJobPositions;       
    use Daos\DaoCompanies as DAOCompanies;
    use Daos\DaoStudents as DAOStudents;
    use models\Career as Career;
    use models\Student as Student;
    use models\Account as Account;
    use Models\Company as Company;
    use models\jobOffer as JobOffer;
    use models\jobPosition as JobPosition;
    use PHPMailer\email as email;

    // agregar esta linea cuando se ejecute el eliminar jobOffer por expiracion: $this->email->sendMail("hiperknife@gmail.com",$ticket);

    class JobOfferController
    {
        private $daoJobOffers;
        private $daoJobPositions;
        private $daoCompanies;
        private $daoStudents;
        private $daoCareers;
        private $email;

        public function __construct()
        {
            $this->daoJobOffers = new DAOJobOffers();
            $this->daoCompanies = new DAOCompanies();
            $this->daoJobPositions = new DAOJobPositions();
            $this->daoStudents = new DAOStudents();
            $this->daoCareers = new DAOCareers;
            $this->email = new email();
        }



        public function showOfferView($message='')
        {
            $offerList = $this->daoJobOffers->getAllOffers();
            $offXposList = $this->daoJobOffers->getAllOffersbyPosition();
            $positionList = $this->daoJobPositions->getAll();   //Armar array de jobpositions desde DAO.

            require_once(VIEWS_PATH . 'offer-list.php');
        }

        public function add($companyId, $offerDescription, $startDate, $endDate, $jobPositionIdArray) //Recibe desde la vista un array con los JobPosition que va a pedir la JobOffer.
        {
            $offer = new JobOffer();
            $offer->setCompanyId($companyId);
            $offer->setOfferDescription($offerDescription);
            $offer->setArrayJobPos($jobPositionIdArray);
            $offer->setStartDate($startDate);
            $offer->setEndDate($endDate);

            var_dump($offer);

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

        public function studentPostulationAdd($jobOfferId)
        {
            //Verificar primero si el alumno ya está postulado.
            $accountAux = new Account();
            $jobOfferAux = new JobOffer();
            $accountAux->setId($_SESSION['account']->getId());
            $jobOfferAux->setOfferId($jobOfferId);

            $this->daoJobOffers->addPostulation($accountAux, $jobOfferAux);
            $this->showOfferView($message = 'Postulación exitosa!');
            
        }

        public function studentPostulationHistory()
        {
            $accountAux = new Account();            
            $accountAux->setId($_SESSION['account']->getId());


            $companiesList = $this->daoCompanies->getAll();
            $positionList = $this->daoJobPositions->getAll();
            $offerList = $this->daoJobOffers->getAllOffersByStudent($accountAux);

            require_once(VIEWS_PATH . "student-history-list.php");
        }

        public function update($offerId, $offerDescription, $startDate, $endDate)
        {
            $jobOfferAux = new JobOffer();
            $jobOfferAux->setOfferId($offerId);
            $jobOfferAux->setOfferDescription($offerDescription);
            $jobOfferAux->setStartDate($startDate);
            $jobOfferAux->setEndDate($endDate);

            try
            {
                $this->daoJobOffers->update($jobOfferAux);
            }

            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function showPostulations()
        {
            $company = new Company();           

            $company = $this->daoCompanies->getByEmail($_SESSION['account']->getEmail());

            $offerList = $this->daoJobOffers->getCompanyOffers($company);
            $positionList = $this->daoJobPositions->getAll();
            $studentList = $this->daoStudents->getStudentsByAccount();
            $careerList = $this->daoCareers->getAll();
            $jxaList = $this->daoJobOffers->getAllJXA(); 

            require_once(VIEWS_PATH . "company-postulations.php");
        }
    }