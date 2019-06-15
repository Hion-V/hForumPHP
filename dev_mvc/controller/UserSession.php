<?php
Class UserSession{
    public $uid = -1;
    public $token = "undefined";
    public $expires;
    public function UserSession($uid, $token = "undefined"){
        $this->uid = $uid;
        $this->token = $token;
        $this->setExpiry();
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
            if(!Database::isSessionValid($_SESSION['usersession']->token, $_SESSION['usersession']->uid)){
                return false;
            }
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
                    $session = new UserSession($uid, $token);
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
        /*
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
        else{
            return false;
        }
        */
        //session exists, no need to do anything
        if(isset($_SESSION['usersession'])){
            return true;
        }
        else{
            if(isset($_COOKIE['usersession'])){
                //check if the session exists in the database
                if(Database::isSessionTokenInUse($_COOKIE['usersession'])){
                    //check if database expiration datetime is still valid
                    $expirationDateTime = Database::getSessionExpiryDate($_COOKIE['usersession']);
                    if(new DateTime($expirationDateTime) >= new DateTime()){
                        //user is signed in. Restore session
                        $userSession = new UserSession($_COOKIE['uid'], $_COOKIE['usersession']);
                        return true;
                    }
                    else{
                        //remove session from the database
                        Database::invalidateSession($_COOKIE['usersession']);
                    }
                }
            }
        }
        //session either doesn't exist, doesn't exist in cookie, doesn't exist in database, or is expired in the database.
        return false;
    }
}
?>