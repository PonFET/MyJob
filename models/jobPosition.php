<?php

namespace models;

class jobPosition{
    private $jobPositionId;
    private $careerId;
    private $description;
    
    function __construct($jobPositionId = 0, $careerId = 0, $description = ""){
        $this->jobPositionId=$jobPositionId;
        $this->careerId=$careerId;
        $this->description=$description;
    }

    public function getJobPositionId(){
        return $this->jobPositionId;
    }

    public function setJobPositionId($jobPositionId){
        $this->jobPositionId = $jobPositionId;
        return $this;
    }

    public function getCareerId(){
        return $this->careerId;
    }

    public function setCareerId($careerId){
        $this->careerId = $careerId;
        return $this;
    }

    public function getDescription(){
        return $this->description;
    }
 
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }
}
?>