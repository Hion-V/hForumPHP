<?php
include_once("UserSession.php");
if(UserSession::isSessionValid()){
    Database::invalidateSession(UserSession::getSession()->token);
    session_destroy();
}





?>