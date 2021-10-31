<?php
    namespace controllers;

    use daos\daoCompanies as DAOCompanies;
    use models\Company as Company;
    use PDOException;

    class companyController
    {
        private $daoCompany;        

        public function __construct()
        {
            $this->daoCompany = new DAOCompanies();
        }



        public function showCompanyView()
        {
            session_start();
            
            $companyList = $this->daoCompany->getAll();

            require_once(VIEWS_PATH . 'view-company.php');
        }


        public function add($companyName, $location, $description, $email, $phoneNumber)
        {
            $company = new Company($companyName, $location, $description, $email, $phoneNumber);

            $this->daoCompany->add($company);

            $this->showCompanyView();
        }


        public function modify($companyId, $companyName, $location, $description, $email, $phoneNumber)
        {
            $company = new Company();
            $company->setCompanyId($companyId);
            $company->setCompanyName($companyName);
            $company->setLocation($location);
            $company->setDescription($description);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);

            $this->daoCompany->update($company);

            $this->showCompanyView();
        }


        public function delete($id)
        {
            $companyList = $this->daoCompany->getAll();
            

            $company = new Company();

            foreach($companyList as $key)
            {
                if($key->getCompanyId() == $id)
                {
                    $company = $key;
                }
            }

            $this->daoCompany->delete($company);

            $this->showCompanyView();
        }        
    }
?>