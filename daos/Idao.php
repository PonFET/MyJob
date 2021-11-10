<?php 

namespace Daos;

use models\Student;

interface Idao {     
    public function getAll();
    public function add($object);
}
?>