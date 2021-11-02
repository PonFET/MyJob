<?php
    namespace Models;

    class Company
    {
        private $companyId;
        private $companyName;
        private $location;
        private $description;
        private $email;
        private $phoneNumber;
        private $cuit;

        function __construct($companyId = 0, $companyName = "", $location = "", $description = "", $email = "", $phoneNumber = 0, $cuit = 0)
        {
                $this->companyId = $companyId;
                $this->companyName = $companyName;
                $this->location = $location;
                $this->description = $description;
                $this->email = $email;
                $this->phoneNumber = $phoneNumber;
                $this->cuit = $cuit;
        }

        /**
         * Get the value of companyId
         */ 
        public function getCompanyId()
        {
                return $this->companyId;
        }

        /**
         * Set the value of companyId
         *
         * @return  self
         */ 
        public function setCompanyId($companyId)
        {
                $this->companyId = $companyId;

                return $this;
        }

        /**
         * Get the value of companyName
         */ 
        public function getCompanyName()
        {
                return $this->companyName;
        }

        /**
         * Set the value of companyName
         *
         * @return  self
         */ 
        public function setCompanyName($companyName)
        {
                $this->companyName = $companyName;

                return $this;
        }

        /**
         * Get the value of location
         */ 
        public function getLocation()
        {
                return $this->location;
        }

        /**
         * Set the value of location
         *
         * @return  self
         */ 
        public function setLocation($location)
        {
                $this->location = $location;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of phoneNumber
         */ 
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        /**
         * Set the value of phoneNumber
         *
         * @return  self
         */ 
        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }

        /**
         * Get the value of cuit
         */ 
        public function getCuit()
        {
                return $this->cuit;
        }

        /**
         * Set the value of cuit
         *
         * @return  self
         */ 
        public function setCuit($cuit)
        {
                $this->cuit = $cuit;

                return $this;
        }
    }

?>