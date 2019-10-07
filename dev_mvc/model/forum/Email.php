<?php
namespace model\forum;
class Email{
    private $email;
    private $valid;
    function __construct($email){
        $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        if(filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)){
            $this->email = $sanitized_email;
            $this->valid = true;
        }
        else{
            $this->email = 'invalid';
            $this->valid = false;
        }
    }
    public function getEmail(){
        return $this->email;
    }
    public function getValid(){
        return $this->valid;
    }
    public function __toString(): string
    {
        return $this->email;
    }
}