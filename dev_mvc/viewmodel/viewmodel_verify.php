<?php
use controller\db\Database;
require_once ROOT_DIR.'/controller/db/Database.php';
require_once ROOT_DIR.'/controller/db/DBUser.php';
$key = '';
if(isset($_GET['key'])){
    $key = $_GET['key'];
}

if(Database::doesUserActivationKeyExist($key)){
    Database::activateUser($key);
}
$completed = true;
?>