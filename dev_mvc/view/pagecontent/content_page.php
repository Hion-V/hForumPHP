<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            <?=HUtils::getSiteTitle();?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="./view/css/main.css" />
    </head>
    <body>
        <header>
            <?php 
                include_once("./view/pagecontent/content_header.php");
            ?>
        </header>
        <main>
<?php
//Store de geselecteerde pagina in variabele $page
$page=HUtils::getPage();
//Laad de juiste view
$path = "./view/pagecontent/content_".$page.".php";

if($page != ""){
    if(file_exists($path)){
    include_once($path);
    }
    else{
        include_once("./view/pagecontent/content_404.php");
    }
}
?>
        </main>
    </body>
</html>