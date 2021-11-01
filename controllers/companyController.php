<?php
    namespace controllers;

    use daos\DaoCompanies as DAOCompanies;
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

            $this->showList();
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

            $this->showList();
        }

        /* Esta funcion utiliza la variable enabled que permite activar las compañias, si bien se crean en otro metodo como activadas/desactivadas este metodo las activa.
            Esto podria llevar a cambiar la funcion de abajo delete en el cual pasariamos a desactivar las compañias en vez de eliminarlas.

        public function addUp($companyId){
            $this->daoCompany->addUp($companyId);
            
            $this->showList();
        }

        */
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

            $this->showList();
        }   
        
        public function showList(){

            $arrayCompany = $this->daoCompany->getAll();
    
            require_once(VIEWS_PATH."list-company.php");
        }

        public function adminList(){

            $arrayCompany = $this->daoCompany->getAll();
            
            require_once(VIEWS_PATH."admin-company.php");
        }

    }
?>