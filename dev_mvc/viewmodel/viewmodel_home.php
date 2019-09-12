<?php 
require_once './controller/UserSession.php';
require_once './controller/MVCController.php';
if(UserSession::isUserSignedIn()){
	MVCController::getMVCController()->overrideView("boards");
}