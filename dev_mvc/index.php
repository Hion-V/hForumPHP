<?php
error_reporting(E_ALL);
ini_set('log_errors','1');
ini_set('display_errors','0');
define('ROOT_DIR', __DIR__);
session_start();
require_once(ROOT_DIR.'/model/testactions/TestAction.php');
//date_default_timezone_set('Europe/Amsterdam');
require_once(ROOT_DIR.'/controller/MVCController.php');
require_once(ROOT_DIR.'/controller/UserSession.php');
$mvcController = new MVCController();
$mvcController->executeModel();
if(!isset($_POST['testaction'])){
    include_once(ROOT_DIR."/view/content_pagetemplate.php");
}
//require_once('aaaadea');
//http_response_code(200);
TestAction::returnLogAsText();
?>