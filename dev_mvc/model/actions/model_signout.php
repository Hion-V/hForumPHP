<?php
use controller\db\Database;
use controller\UserSession;

$_SESSION['usersession'] = null;
Database::invalidateSession($_COOKIE['usersession']);
session_destroy();
?>