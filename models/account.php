<?php

namespace models;

class Account{
	private $id;
	private $email;
	private $password;
	private $privilegios;
	

	function __construct ($email="", $password="", $privilegios="") {		
		$this->email = $email;
		$this->password = $password;
		$this->privilegios = $privilegios;
    }

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
		return $this;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
		return $this;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
		return $this;
	}

	public function getPrivilegios(){
		return $this->privilegios;
	}

	public function setPrivilegios($privilegios){
		$this->privilegios = $privilegios;
		return $this;
    }
}