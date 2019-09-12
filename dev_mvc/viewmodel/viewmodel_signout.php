<?php
require_once('./controller/db/Database.php');
Database::invalidateSession($_COOKIE['usersession']);
session_destroy();
?>