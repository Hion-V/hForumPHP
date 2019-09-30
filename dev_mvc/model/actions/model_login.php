<?php
$debuginfo = false;
use controller\UserSession;
use controller\db\Database;
use controller\db\DBUser;
use controller\HUtils;
use controller\MVCController;
use model\forum\User;
$skipoverride = false;
if(!UserSession::isUserSignedIn()){
	if(HUtils::issetPost(['email','password'])){
		if(DBUser::isLoginValid($_POST['email'], $_POST['password'])){
			//obtain UID 
			$uid = DBUser::getUID($_POST['email'], $_POST['password']);
			if($uid != -1){
				//check if user account has been activated
				if(DBUser::getUserByUID($uid)->getActive()){
					//obtain username
					//$username = DBUser::getUsername($uid);
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
					MVCController::getMVCController()->overrideView("account_inactive");
					$skipoverride = true;
					echo('ree');
				}
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

if(!UserSession::isUserSignedIn() &&!$skipoverride){
	MVCController::getMVCController()->overrideView("error_login");
}

?>