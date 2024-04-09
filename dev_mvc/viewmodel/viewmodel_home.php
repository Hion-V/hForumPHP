<?php 
use controller\UserSession;
use controller\MVCController;
if(UserSession::isUserSignedIn()){
	MVCController::getMVCController()->overrideView("boards");
}