<?php
    namespace models;

use DateTime;

class jobOffer
    {
        private $offerId;
        private $companyId;        
        private $offerDescription;
        private $arrayJobPos;
        private $startDate;
        private $endDate;
        private $offerImg;
        private $enable;

        function __construct($offerId = 0, $companyId = 0, $offerDescription = '', $arrayJobPos = array(), $startDate='', $endDate='', $offerImg='')
        {
            $this->offerId = $offerId;
            $this->companyId = $companyId;            
            $this->offerDescription = $offerDescription;
            $this->arrayJobPos = $arrayJobPos;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            $this->offerImg = $offerImg;            
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

        /**
         * Get the value of enable
         */ 
        public function getEnable()
        {
                return $this->enable;
        }

        /**
         * Set the value of enable
         *
         * @return  self
         */ 
        public function setEnable($enable)
        {
                $this->enable = $enable;

                return $this;
        }

        /**
         * Get the value of startDate
         */ 
        public function getStartDate()
        {
                return $this->startDate;
        }

        /**
         * Set the value of startDate
         *
         * @return  self
         */ 
        public function setStartDate($startDate)
        {
                $this->startDate = $startDate;

                return $this;
        }

        /**
         * Get the value of endDate
         */ 
        public function getEndDate()
        {
                return $this->endDate;
        }

        /**
         * Set the value of endDate
         *
         * @return  self
         */ 
        public function setEndDate($endDate)
        {
                $this->endDate = $endDate;

                return $this;
        }

        /**
         * Get the value of offerImg
         */ 
        public function getOfferImg()
        {
                return $this->offerImg;
        }

        /**
         * Set the value of offerImg
         *
         * @return  self
         */ 
        public function setOfferImg($offerImg)
        {
                $this->offerImg = $offerImg;

                return $this;
        }
        
    }