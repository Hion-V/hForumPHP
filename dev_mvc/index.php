<?php
function echol($output)
{
    echo $output;
    echo "<br>";
}

//date_default_timezone_set('Europe/Amsterdam');
require_once('./controller/MVCController.php');
require_once('./controller/UserSession.php');
session_start();
$mvcController = new MVCController();
$mvcController->executeModel();
if(!isset($_POST['admin'])){
    include_once("./view/content_pagetemplate.php");
}
?>