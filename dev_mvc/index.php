<?php
/*Code door Andreas Schaafsma ITA4-1b
 *
 * Notities voor bij nakijken
 * $_POST[] is gebruikt binnen de model_attempt_login.php en model_attempt_register.php bestanden
 * Alle regeling van de database connectie zit in ./controller/Database.php doormiddel van static class members om alles makkelijk te groeperen
 * Er is ook een rudimentair login token systeem om ervoor te zorgen dat gebruikers ingelogd blijven zelfs als de $_SESSION[] vervalt.
 * Deze login status verdwijnt weer na ongeveer een uurtje
 *
*/
//include class lib.
include_once("./controller/Database.php");
include_once("./controller/UserSession.php");
include_once("./controller/HUtils.php");
session_start();
//Store de geselecteerde pagina in variabele $page
$page=HUtils::getPage(HUtils::FETCHPOST);
//Model side operaties die afgerond moeten worden voor de paginacontent in wordt geladen
$path = "./model/model_".$page.".php";
if($page != ""){
    if(file_exists($path)){
        include_once($path);
    }
}
//laad de pagina view
include("./view/pagecontent/content_page.php");
?>