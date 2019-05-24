<?php
$debuginfo = false;
include_once("./controller/UserSession.php");
include_once("./controller/Database.php");
include_once("./controller/HUtils.php");
if(!UserSession::isUserSignedIn()){
    if(HUtils::issetPost(['email','password'])){
        if(Database::isLoginValid($_POST['email'], $_POST['password'])){
            //obtain UID
            $uid = Database::getUID($_POST['email'], $_POST['password']);
            if($uid != -1){
                //obtain username
                $username = Database::getUsername($uid);
                //gen unique session token
                $token = UserSession::generateToken();
                //regen if already in use
                while(Database::isSessionTokenInUse($token)){
                    $token = UserSession::generateToken();
                }
                $a = new UserSession($uid, $token);
                if($debuginfo){
                    echo $a->getSessionToken();
                    echo "<br>";
                    echo $a->uid;
                    echo "<br>";
                    echo $a->username;
                }
                //clean up expired sessions from ANY users
                Database::deleteExpiredSessions();
                Database::registerNewSession($a->uid, $a->token, $a->getFormattedExpiry());
                //logged in, time to continue with other stuff
            }
            else{
                echo "uid returned -1 from db interface";
            }
        }
        else{
            echo("login invalid");
        }
    }
}
else{
    //we're done, don't even need to log in, session already active
}
?>