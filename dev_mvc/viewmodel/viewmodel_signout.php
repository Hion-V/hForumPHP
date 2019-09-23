<?php
require_once(ROOT_DIR.'./controller/db/Database.php');
Database::invalidateSession($_COOKIE['usersession']);
session_destroy();
?>