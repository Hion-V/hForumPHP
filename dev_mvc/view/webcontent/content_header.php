<?php 
use controller\UserSession;
if(UserSession::isUserSignedIn()){
	include(ROOT_DIR.'/view/webcontent/header/header_signedin.php');
}
else{
	include(ROOT_DIR.'/view/webcontent/header/header_signedout.php');
}
?>