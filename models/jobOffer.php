<?php
    namespace models;

    class jobOffer
    {
        private $offerId;
        private $companyId;        
        private $offerDescription;
        private $arrayJobPos;

        function __construct($offerId = 0, $companyId = 0, $offerDescription = '', $arrayJobPos = array())
        {
            $this->offerId = $offerId;
            $this->companyId = $companyId;            
            $this->offerDescription = $offerDescription;
            $this->arrayJobPos = $arrayJobPos;
        }

        /**
         * Get the value of offerId
         */ 
        public function getOfferId()
        {
                return $this->offerId;
        }

        /**
         * Set the value of offerId
         *
         * @return  self
         */ 
        public function setOfferId($offerId)
        {
                $this->offerId = $offerId;

                return $this;
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
         * Get the value of offerDescription
         */ 
        public function getOfferDescription()
        {
                return $this->offerDescription;
        }

        /**
         * Set the value of offerDescription
         *
         * @return  self
         */ 
        public function setOfferDescription($offerDescription)
        {
                $this->offerDescription = $offerDescription;

                return $this;
        }

        /**
         * Get the value of arrayJobPos
         */ 
        public function getArrayJobPos()
        {
                return $this->arrayJobPos;
        }

        /**
         * Set the value of arrayJobPos
         *
         * @return  self
         */ 
        public function setArrayJobPos($arrayJobPos)
        {
                $this->arrayJobPos = $arrayJobPos;

                return $this;
        }
    }