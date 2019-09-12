<?php

class User {
	public $id;
	public $username;
	public $email;
	public $password;
	public $reg_date;
	public $login_date;
	public $reg_ip;
	public $permissions;
	function User($id, $username, $email, $password, $reg_date, $login_date, $reg_ip, $permissions){
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->reg_date = $reg_date;
		$this->login_date = $login_date;
		$this->reg_ip=$reg_ip;
		$this->permissions=$permissions;
	}
	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @return mixed
	 */
	public function getUsername() {
		return $this->username;
	}
	
	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 * @return mixed
	 */
	public function getReg_date() {
		return $this->reg_date;
	}
	
	/**
	 * @return mixed
	 */
	public function getLogin_date() {
		return $this->login_date;
	}
	
	/**
	 * @return mixed
	 */
	public function getReg_ip() {
		return $this->reg_ip;
	}
	
	/**
	 * @return mixed
	 */
	public function getPermissions() {
		return $this->permissions;
	}
	
	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * @param mixed $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}
	
	/**
	 * @param mixed $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	/**
	 * @param mixed $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}
	
	/**
	 * @param mixed $reg_date
	 */
	public function setReg_date($reg_date) {
		$this->reg_date = $reg_date;
	}
	
	/**
	 * @param mixed $login_date
	 */
	public function setLogin_date($login_date) {
		$this->login_date = $login_date;
	}
	
	/**
	 * @param mixed $reg_ip
	 */
	public function setReg_ip($reg_ip) {
		$this->reg_ip = $reg_ip;
	}
	
	/**
	 * @param mixed $permissions
	 */
	public function setPermissions($permissions) {
		$this->permissions = $permissions;
	}
	
	


}

