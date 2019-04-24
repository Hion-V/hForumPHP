<?php
class User{
    static $userArray = [];
    public $id;
    public $username;
    public $email;
    public function User($id, $username, $email, $password){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        array_push(User::$userArray, $this);
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
}
?>