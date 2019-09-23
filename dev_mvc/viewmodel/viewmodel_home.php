<?php 
require_once ROOT_DIR.'/controller/UserSession.php';
require_once ROOT_DIR.'/controller/MVCController.php';
if(UserSession::isUserSignedIn()){
	MVCController::getMVCController()->overrideView("boards");
}