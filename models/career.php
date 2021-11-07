<?php

namespace models;

class Career{
    private $careerId;
    private $description;
    private $active;
    
    function __construct($careerId = 0, $description = '',  $active = null){
        $this->careerId=$careerId;
        $this->description=$description;
        $this->active=$active;
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

    public function getActive(){
        return $this->active;
    }

    public function setActive($active){
        $this->active = $active;
        return $this;
    }
}
?>