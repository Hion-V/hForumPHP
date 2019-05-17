<?php
/*Code door Andreas Schaafsma ITA4-1b
 *
 * Notities voor bij nakijken
 * Model wordt opgevraagd via POST (of via GET doormiddel van de ActionHandler controller.)
 * MAIL is werkend en stuurt een verificatiecode op zie: model_do_register
 * Activeringscode wordt correct opgeslagen in de database maar de pagina voor activeren is nog niet geimplementeerd.
 * Alle regeling van de database connectie zit in ./controller/Database.php doormiddel van static class members om alles makkelijk te groeperen
 * Er is ook een rudimentair login token systeem om ervoor te zorgen dat gebruikers ingelogd blijven zelfs als de $_SESSION[] vervalt.
 * Deze login status verdwijnt weer na ongeveer een uurtje.
 *
*/
//include class lib.
include_once("./controller/Database.php");
include_once("./controller/UserSession.php");
include_once("./controller/HUtils.php");
include_once("./controller/ActionHandler.php");

session_start();
ActionHandler::doAction();



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