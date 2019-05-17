<?php
include_once("./controller/Database.php");
$key = '';
if(isset($_GET['key'])){
    $key = $_GET['key'];
}

if(Database::doesUserActivationKeyExist($key)){
    Database::activateUser($key);
}
$completed = true;
?>