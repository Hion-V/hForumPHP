<?php
require_once('./controller/db/Database.php');
$_SESSION['usersession'] = null;
Database::invalidateSession($_COOKIE['usersession']);
session_destroy();
?>