<?php 

namespace controllers;

class HomeController {
    public function Index(){
        require_once(VIEWS_PATH."header.php");
        require_once(VIEWS_PATH."login.php");
    }
}
?>