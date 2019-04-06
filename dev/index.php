<?php  
//include class lib.
include_once("./app/db/Database.php");
include_once("./app/login/UserSession.php");
include_once("./app/HUtils.php");
session_start();
//initialiseer standaard variabelen 
$p="";
//check of pagina gespecificeerd is in de
if(isset($_GET['p'])){
    $p = $_GET['p'];
}
//Doe server-side operaties die afgerond moeten worden voordat de pagina is geladen.
switch($p){
    case 'destroy':
        include("./app/login/destroy.php");
        break;
    case 'attempt_login':
        include("./app/login/attempt_login.php");
        break;
    case 'attempt_logout':
        include("./app/login/attempt_logout.php");
        break;
    case 'attempt_reg':
        include("./app/registration/attempt_register.php");
        break;
    default:
        break;
}
//laad de pagina
include("./app/pagecontent/content_page.php");
?>