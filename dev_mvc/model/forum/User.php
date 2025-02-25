<?php
namespace model\forum;
class User {
	public $id;
	public $username;
	public $email;
	public $password;
	public $reg_date;
	public $login_date;
	public $reg_ip;
	public $permissions;
	public $active;
	function __construct($id, $username, $email, $password, $reg_date, $login_date, $reg_ip, $permissions, $active){
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->reg_date = $reg_date;
		$this->login_date = $login_date;
		$this->reg_ip=$reg_ip;
		$this->permissions=$permissions;
		$this->active = $active;
	}
	/**
	 * @return mixed
	 */
	public function getId():int {
		return $this->id;
	}
	
	/**
	 * @return mixed
	 */
	public function getUsername():string {
		return $this->username;
	}
	
	/**
	 * @return mixed
	 */
	public function getEmail():string {
		return $this->email;
	}
	
	/**
	 * @return mixed
	 */
	public function getPassword():string {
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
	 * @param mixed
	 */
	public function getActive() {
		return $this->active;
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
	/**
	 * @param mixed $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}
	
	


}

