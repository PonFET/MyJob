<?php
    namespace Controllers;

    use Daos\DaoCompanies as DAOCompanies;
    use models\Company as Company;
    use Daos\DaoAccounts as DAOAccounts;
    use PDOException;

    class CompanyController
    {
        private $daoCompany;
        private $daoAccount;        

        public function __construct()
        {
            $this->daoCompany = new DAOCompanies();
            $this->daoAccount = new DAOAccounts();
        }



        public function showCompanyView()
        {
            $companyList = $this->daoCompany->getAll();

            require_once(VIEWS_PATH . 'view-company.php');
        }

        public function add($companyName, $location, $description, $email, $phoneNumber, $cuit)
        {
            $company = new Company($companyName, $location, $description, $email, $phoneNumber, $cuit);

            $this->daoCompany->add($company);

            $this->showList();
        }

        public function showModify($companyId){
            
            $company = $this->daoCompany->getById($companyId);
            require_once(VIEWS_PATH."update-company.php");
        }

        public function modify($companyId, $companyName, $location, $description, $email, $phoneNumber, $cuit)
        {
            $company = new Company();
            $company->setCompanyId($companyId);
            $company->setCompanyName($companyName);
            $company->setLocation($location);
            $company->setDescription($description);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);
            $company->setCuit($cuit);

            $this->daoCompany->update($company);

            $this->showList();
        }

        public function delete($id)
        {
            $companyList = $this->daoCompany->getAll();
            
            $company = new Company();
            $mail = null;

            foreach($companyList as $key)
            {
                if($key->getCompanyId() == $id)
                {
                    $company = $key;
                    $mail = $key->getEmail();
                }
            }            

            $this->daoCompany->delete($company);

            $this->daoAccount->delete($mail);

            header("Location: adminList");
        }   
        
        public function showList(){

            $arrayCompany = $this->daoCompany->getAll();
    
            require_once(VIEWS_PATH."list-company.php");
        }

        public function viewCompany(){

            require_once(VIEWS_PATH."view-company.php");
        }

        public function adminList(){

            $arrayCompany = $this->daoCompany->getAll();
            
            require_once(VIEWS_PATH."admin-company.php");
        }

    }
?>