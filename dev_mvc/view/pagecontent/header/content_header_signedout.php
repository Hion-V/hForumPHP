<?php
include_once("./controller/AssetHandler.php");
AssetHandler::printAsset("logo.png", true, 128);
?>
<nav>
    <a href="?p=login">log in</a> <a href="?p=register">register</a> <a href="?p=">home</a>
</nav>