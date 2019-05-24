<?php
Database::invalidateSession($_COOKIE['usersession']);
session_destroy();
?>