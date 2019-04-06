<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            <?=$sSiteTitle?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    </head>
    <body>
        <header>
            <?php 
            if(UserSession::isUserSignedIn()){
                include("./app/pagecontent/content_header_signedin.php");
            }else{
                include("./app/pagecontent/content_header.php"); 
            }
            ?>
        </header>
        <main>
<?php
//Laad juiste pagina content
switch($p){
    case '':
        include("./app/pagecontent/content_index.php");
        break;
    case 'register':
        include("./app/pagecontent/login/content_register.php");
        break;
    case 'login':
        include("./app/pagecontent/login/content_login.php");
        break;
    case 'attempt_reg':
    	include("We signed you up (probably)");
        break;
    case 'attempt_login':
        if(UserSession::isUserSignedIn()){
            include("./app/pagecontent/login/content_login_succesful.php");
        }else{
            include("./app/pagecontent/login/content_login_unsuccesful.php");
        }
        break;
    case 'attempt_logout':
        break;
    case 'destroy':
        include("./app/pagecontent/login/content_destroy.php");
        break;
    default:
        echo "404";
        break;
}
?>
        </main>
    </body>
</html>