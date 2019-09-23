<?php
error_reporting(E_ALL);
ini_set('log_errors','1');
ini_set('display_errors','1');
define('ROOT_DIR', __DIR__);
register_shutdown_function(function() {
    $error = error_get_last();
    switch($error['type']){
        case E_ERROR:
            http_response_code(500);
            header('HTTP/1.1 500 Internal Server Error');
            break;
        case E_PARSE:
            http_response_code(500);
            header('HTTP/1.1 500 Internal Server Error');
            break;
        case E_CORE_ERROR:
            http_response_code(500);
            header('HTTP/1.1 500 Internal Server Error');
            break;
        case E_COMPILE_ERROR:
            http_response_code(500);
            header('HTTP/1.1 500 Internal Server Error');
            break;
        case E_USER_ERROR:
            http_response_code(500);
            header('HTTP/1.1 500 Internal Server Error');
            break;
        case E_RECOVERABLE_ERROR:
            http_response_code(500);
            header('HTTP/1.1 500 Internal Server Error');
            break;
    }

    /* if ($error['type'] == E_ERROR || $error['type'] == E_PARSE || $error['type'] == E_CORE_ERROR || $error['type'] == E_COMPILE_ERROR || $error['type'] == E_RECOVERABLE_ERROR) {
        header('HTTP/1.1 500 Internal Server Error');
        http_response_code(500);
    } */
});
require_once(ROOT_DIR.'/model/testactions/TestAction.php');
//date_default_timezone_set('Europe/Amsterdam');
require_once(ROOT_DIR.'/controller/MVCController.php');
require_once(ROOT_DIR.'/controller/UserSession.php');
session_start();
$mvcController = new MVCController();
$mvcController->executeModel();
if(!isset($_POST['testaction'])){
    include_once(ROOT_DIR."/view/content_pagetemplate.php");
}
//require_once('aaaadea');
//http_response_code(200);
TestAction::returnLogAsText();
?>