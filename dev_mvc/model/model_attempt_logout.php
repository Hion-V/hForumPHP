<?php
include_once("./controller/UserSession.php");
if(UserSession::isSessionValid()){
    Database::invalidateSession(UserSession::getSession()->token);
    session_destroy();
}
?>