<?php
require_once(ROOT_DIR.'/controller/db/Database.php');
$_SESSION['usersession'] = null;
Database::invalidateSession($_COOKIE['usersession']);
session_destroy();
?>