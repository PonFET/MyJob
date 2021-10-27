<?php
namespace daos;

require_once("config.autoload.php");

use daos\Connection as connection;
use models\Cuenta as cuenta;
use PDOException;

class daoCuentas implements Idao{
    private $connection;
    private static $instance = null;
    const COLUMN_ENABLED = "enabled";

    public function __construct(){

    }



    
}
?>