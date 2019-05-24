<?php
include_once("./controller/AssetHandler.php");
AssetHandler::printAsset("logo.png", true, 128);
?>
<nav>
    <a href="?action=signout">log out</a> <a href="?p=">home</a> <a href="?p=create_topic">create thread</a> <a href="?action=destroy">simulate $_SESSION expiry</a>
</nav>