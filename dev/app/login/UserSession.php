<?php
Class UserSession{
    public $username = "undefined";
    public $uid = -1;
    public $token = "undefined";
    public $expires;
    public function UserSession($username, $uid, $token = "undefined"){
        $this->username = $username;
        $this->uid = $uid;
        $this->token = $token;
        $this->setExpiry();
        //echo($username."<br>");
        //echo($loginSessionToken);
        $_SESSION['usersession'] = $this;
        setcookie('usersession', $this->token);
        setcookie('uid', $this->uid);
    }
    public function setSessionToken($token){
        $this->token = $token; 
    }
    public function getSessionToken(){
        return $this->token;
    }
    public function getFormattedExpiry(){
        return $this->expires->format('Y-m-d H:i:s');
    }
    public function setExpiry(){
        $this->expires = new DateTime();
        $this->expires->modify("+ 1 hour");
    }
    public static function generateToken(){
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $token = "";
        for ($i=0; $i < 32 ; $i++) { 
            $token .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $token;
    }
    public static function isSessionValid(){
        if(isset($_SESSION['usersession'])){
            if(!UserSession::isSessionExpired($_SESSION['usersession'])){
                //check if session also exists in database
                return true;
            }
        }
        else{
            if(isset($_COOKIE['usersession'])){
                $token = $_COOKIE['usersession'];
                $uid = $_COOKIE['uid'];
                if(Database::isSessionValid($token,$uid)){
                    $username = Database::getUsername($uid);
                    $session = new UserSession($username, $uid, $token);
                    $session->expires = new DateTime(Database::getSessionExpiryDate($token));
                }
                else{
                    return false;
                }
                if(!UserSession::isSessionExpired($session)){
                    return true;
                }
            }
            return false;
        }
    }
    public static function getSession()
    {   
        return $_SESSION['usersession'];
    }
    public static function isSessionExpired($session){
        //session is expired
        if(new DateTime() > $session->expires){
            return true;
        }
        //session is not expired
        else{
            return false;
        }
    }
    public static function isUserSignedIn(){
        if(UserSession::isSessionValid()){
            if(!UserSession::isSessionExpired(UserSession::getSession())){
                if(Database::isSessionValid(UserSession::getSession()->token, UserSession::getSession()->uid)){
                    return true;
                }
            }
            else{
                return false;
            }
        }
    }
}
?>