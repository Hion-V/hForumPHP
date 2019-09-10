<?php

$host="172.21.0.3"; //docker sql container bridge ip

$root="root"; 
$root_password="jenk"; //testdb password

$user='forumadmin';
$pass='doesntmatter';
$db="webforum"; 

    try {
        $dbh = new PDO("mysql:host=$host", $root, $root_password);

        $dbh->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;") 
        or die(print_r($dbh->errorInfo(), true));

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

    try {
        $dsn = "mysql:host=$host;dbname=$db";
        //Maak verbinding
        $con = new PDO($dsn, $user, $pass);
        $con->exec("CREATE TABLE `board` (
                    `ID` int(16) NOT NULL AUTO_INCREMENT,
                    `name` varchar(256) NOT NULL,
                    `description` text NOT NULL,
                    `permLevel` int(16) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`ID`) ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1"); 
        $con->exec("CREATE TABLE `email_activation_keys` (
                    `id` int(16) NOT NULL AUTO_INCREMENT,
                    `users_id` int(16) NOT NULL,
                    `activationkey` varchar(256) NOT NULL,
                    PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1"); 
        $con->exec("CREATE TABLE `reply` (
                    `ID` int(16) NOT NULL AUTO_INCREMENT,
                    `thread_ID` int(16) NOT NULL,
                    `users_ID` int(16) NOT NULL,
                    `content` text NOT NULL,
                    `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`ID`) ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1"); 
        $con->exec("CREATE TABLE `thread` (
                    `ID` int(16) NOT NULL AUTO_INCREMENT,
                    `users_ID` int(16) NOT NULL,
                    `board_ID` int(16) NOT NULL,
                    `title` varchar(256) NOT NULL,
                    `text` text NOT NULL,
                    `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`ID`) ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1"); 
        $con->exec("CREATE TABLE `users` (
                    `ID` int(11) NOT NULL AUTO_INCREMENT,
                    `username` varchar(256) NOT NULL,
                    `email` varchar(256) NOT NULL,
                    `password` varchar(256) NOT NULL,
                    `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `login_date` datetime NOT NULL,
                    `reg_ip` varchar(256) NOT NULL,
                    `permissions` int(11) NOT NULL DEFAULT '-1',
                    `active` tinyint(1) DEFAULT '0',
                    PRIMARY KEY (`ID`) ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1"); 
        $con->exec("CREATE TABLE `usersessions` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `uid` int(11) NOT NULL,
                    `token` varchar(256) NOT NULL,
                    `expires` datetime NOT NULL,
                    PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1"); 
    }
    catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }


    
?>