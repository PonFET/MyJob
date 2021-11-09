<?php

namespace models;

class Account{
	private $id;
	private $email;
	private $password;
	private $privilegios;
	private $studentId;

	function __construct ($email="", $password="", $privilegios="", $studentId = 0) {		
		$this->email = $email;
		$this->password = $password;
		$this->privilegios = $privilegios;
		$this->studentId = $studentId;
		
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
    
	public function getStudentId(){
		return $this->studentId;
	}

	public function setStudentId($studentId){
		$this->studentId = $studentId;
		return $this;
	}
}