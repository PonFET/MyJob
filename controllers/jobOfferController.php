<?php
    namespace Controllers;

    use Daos\DaoJobOffers as DAOJobOffers;
    use Daos\DaoAccounts as DAOAccounts;
    use Daos\DaoCareers as DAOCareers;
    use Exception;
    use Daos\DaoJobPositions as DAOJobPositions;       
    use Daos\DaoCompanies as DAOCompanies;
    use Daos\DaoStudents as DAOStudents;
use DateTime;
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
        private $daoAccounts;
        private $email;

        public function __construct()
        {
            $this->daoJobOffers = new DAOJobOffers();
            $this->daoCompanies = new DAOCompanies();
            $this->daoJobPositions = new DAOJobPositions();
            $this->daoStudents = new DAOStudents();
            $this->daoCareers = new DAOCareers;
            $this->daoAccounts = new DAOAccounts();
            $this->email = new email();
        }



        public function showOfferView($message='') //Estudiante. Mostrar solamente Offers de su carrera y solamente activas.
        {
            $this->checkOfferExpiration();
            
            $offerList = $this->daoJobOffers->getAllEnabledOffers();            
            $positionList = $this->daoJobPositions->getAll();
            $careerList = $this->daoCareers->getAll();
            $student = $this->daoStudents->getStudentByEmailAPI($_SESSION['account']->getEmail());
            $companiesList = $this->daoCompanies->getAll();
            $jxaList = $this->daoJobOffers->getAllJXA();

            require_once(VIEWS_PATH . 'offer-list.php');
        }

        public function add($companyId, $offerDescription, $endDate, $jobPositionIdArray, $offerImg) //Recibe desde la vista un array con los JobPosition que va a pedir la JobOffer.
        {
            $offer = new JobOffer();
            $offer->setCompanyId($companyId);
            $offer->setOfferDescription($offerDescription);
            $offer->setArrayJobPos($jobPositionIdArray);
            $now = new DateTime();
            $now->setTimezone(new \DateTimeZone('America/Argentina/Buenos_Aires'));
            $offer->setStartDate($now->format("Y-m-d H:i:s"));
            $offer->setEndDate($endDate);

            $this->uploadImg($offerImg);

            $this->daoJobOffers->add($offer);
            $this->daoJobOffers->addImg($offerImg);

            header("Location: ShowListActive");
        }

        public function uploadImg($offerImg){

            $fileTmpName = $_FILES['file']['tmp_name'];
            
            if($offerImg == NULL){

                // Quizas no sea necesario guardar la imagen, simplemente cuando se muestra la imagen se pregunta si es null mostrar esta imagen desde base de datos
                //$fileDestination = 'views/image/No-image-available.png';
                //move_uploaded_file($fileTmpName, $fileDestination);

            }
            else{
                $file = $_FILES['file'];

                $fileName = $_FILES['file']['name'];
                $fileSize = $_FILES['file']['size'];
                $fileError = $_FILES['file']['error'];
                $fileType = $_FILES['file']['type'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg','png','jpeg','pnf');

                if(in_array($fileActualExt, $allowed)){
                    if($fileError === 0){
                        if($fileSize < 1000000){
                            $fileNewName = uniqid('',true) . "." . $fileActualExt;

                            // Si lo queremos guardar en una carpeta de nuestro proyecto
                            $fileDestination  = 'views/image/' . $fileNewName;

                            move_uploaded_file($fileTmpName, $fileDestination);
                        }
                        else{
                            $this->ShowAddOfferView("El archivo es demasiado pesado.");
                        }
                    }
                    else{
                        $this->ShowAddOfferView("Hubo un error subiendo el archivo.");
                    }
                }
                else{
                    $this->ShowAddOfferView("No puedes subir este tipo de archivo.");
                }
            }
        }

        public function ShowImg($offerId)
        {
            $this->daoJobOffers->getImg($offerId);
        }
        
        public function ShowAddOfferView($message='')
        {
            $positionList = $this->daoJobPositions->getAll();            
            $companiesList = $this->daoCompanies->getAll();

            require_once(VIEWS_PATH . 'add-offer.php');
        }

        public function ShowListActive()
        {
            $this->checkOfferExpiration();
            
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

        public function studentPostulationHistory() //Mostrar todas las Offer pero indicar si están expiradas.
        {
            $accountAux = new Account();            
            $accountAux->setId($_SESSION['account']->getId());

            $this->checkOfferExpiration();

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

        public function showCompanyPostulations() //Mostrar todas las offer igualmente
        {
            $company = new Company();           

            $company = $this->daoCompanies->getByEmail($_SESSION['account']->getEmail());

            $this->checkOfferExpiration();

            $offerList = $this->daoJobOffers->getCompanyOffers($company);
            $positionList = $this->daoJobPositions->getAll();
            $studentList = $this->daoStudents->getStudentsByAccount();
            $careerList = $this->daoCareers->getAll();
            $jxaList = $this->daoJobOffers->getAllJXA();            

            require_once(VIEWS_PATH . "company-postulations.php");
        }

        public function deletePostulation($offerId, $email, $companyName)
        {
            try
            {
                $account = $this->daoAccounts->getByEmail($email);

                $this->daoJobOffers->deletePostulation($offerId, $account->getId());

                $offer = $this->daoJobOffers->getOffersById($offerId);

                $this->email->sendPostulationDelete($email, $offer, $companyName);

                header("Location: showAdminPostulations");
            }

            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function showAdminPostulations() //Mostrar todas las Offer igual.
        {
            $this->checkOfferExpiration();
            
            $companiesList = $this->daoCompanies->getAll();
            $offerList = $this->daoJobOffers->getAllOffers();
            $positionList = $this->daoJobPositions->getAll();
            $studentList = $this->daoStudents->getStudentsByAccount();
            $careerList = $this->daoCareers->getAll();
            $jxaList = $this->daoJobOffers->getAllJXA();            

            require_once(VIEWS_PATH . "admin-postulations.php");
        }

        public function checkOfferExpiration()
        {
            try
            {
                $offerList = $this->daoJobOffers->checkExpiration();

                $companiesList = $this->daoCompanies->getAll();
                //$offerList = $this->daoJobOffers->getAllDisabledOffers();
                $jxaList = $this->daoJobOffers->getAllJXA();
                $accountList = $this->daoAccounts->getAll();

                foreach($jxaList as $jxa)
                {
                    foreach($accountList as $account)
                    {
                        if($account->getId() == $jxa['accountId'])
                        {
                            foreach($offerList as $offer)
                            {
                                if($offer->getOfferId() == $jxa['offerId'])
                                {
                                    foreach($companiesList as $company)
                                    {
                                        if($company->getCompanyId() == $offer->getCompanyId())
                                        {
                                            $this->email->sendExpirationOffer($account->getEmail(), $offer, $company->getCompanyName());
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            catch(Exception $ex)
            {
                throw $ex;
            }            
        }       

    }