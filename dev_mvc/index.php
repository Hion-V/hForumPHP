<?php
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error['type'] == E_ERROR || $error['type'] == E_PARSE || $error['type'] == E_CORE_ERROR || $error['type'] == E_COMPILE_ERROR || $error['type'] == E_RECOVERABLE_ERROR) {
        header('HTTP/1.1 500 Internal Server Error');
        http_response_code(500);
    }
});
require_once('./model/testactions/TestAction.php');
//date_default_timezone_set('Europe/Amsterdam');
require_once('./controller/MVCController.php');
require_once('./controller/UserSession.php');
session_start();
$mvcController = new MVCController();
$mvcController->executeModel();
if(!isset($_POST['testaction'])){
    include_once("./view/content_pagetemplate.php");
}
http_response_code(200);
?>