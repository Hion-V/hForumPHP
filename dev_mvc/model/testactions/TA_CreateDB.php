<?php
namespace model\testactions;
use PDO;
use PDOException;
class TA_CreateDB extends TestAction{
    function TA_CreateDB(){
        echo("aids");
        parent::__construct();
    }
    function execute(){
        echo("aids");
        try{
            if(getenv("SQL_CREDENTIALS") !== false){
                $sql_server = getenv("SQL_SERVER");
                $sql_username = getenv("SQL_USERNAME");
                $sql_password = getenv("SQL_PASSWORD");
                $sql_database = getenv("SQL_DATABASE");
            }
            else{
            $sql_server = "database";
            $sql_username = "root";
            $sql_password = "tiger";
            $sql_database = "webforum";
        }
        $host = $sql_server;
        $db = $sql_database;
        $user = $sql_username;
        $pass = $sql_password;
        
        //connect to sql server
        $con = new PDO( "mysql:host=$host;charset=utf8", $user, $pass );
        //check if db exists
        $query = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'");
        //db exists
        if($query->fetchColumn() != 1){
            $query = $con->query("CREATE DATABASE $db");
            self::logMessage('db doesnt exist');
        }
        //db doesn't exist
        else{
            self::logMessage('db already exists, skipping');
        }
        //select db
        $con->exec("USE $db");
        //test if table exists
        
        $table = 'users';
        $query = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$table'");
        self::logMessage($query->fetchColumn());
        //table doesn't exist
        if($query->fetchColumn() != 4){
            self::logMessage('table doesnt exist');
            $query = $con->query(
                "	CREATE TABLE `users` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(256) NOT NULL,
                `email` varchar(256) NOT NULL,
                `password` varchar(256) NOT NULL,
                `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `login_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `reg_ip` varchar(256) NOT NULL DEFAULT '127.0.0.1',
                `permissions` int(11) NOT NULL DEFAULT '-1',
                `active` tinyint(1) DEFAULT '0',
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
            self::logMessage("created table $table");
        }
        //table exists
        else{
            self::logMessage("table $table already exists, skipping");
        }
            
        $table = 'usersessions';
        $query = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$table'");
        if($query->fetchColumn() != 4){
            self::logMessage('table doesnt exist');
            $query = $con->query(
                "	CREATE TABLE `usersessions` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `uid` int(11) NOT NULL,
            `token` varchar(256) NOT NULL,
            `expires` datetime NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
            self::logMessage("created table $table");
        }
        //table exists
        else{
            self::logMessage("table $table already exists, skipping");
        }
        
        $table = 'email_activation_keys';
        $query = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$table'");
        if($query->fetchColumn() != 4){
            self::logMessage('table doesnt exist');
            $query = $con->query(
                "	CREATE TABLE `email_activation_keys` (
                `id` int(16) NOT NULL AUTO_INCREMENT,
                `users_id` int(16) NOT NULL,
                `activationkey` varchar(256) NOT NULL,
                PRIMARY KEY (`id`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
            self::logMessage("created table $table");
            }
            //table exists
            else{
                self::logMessage("table $table already exists, skipping");
            }
            
            $table = 'board';
            $query = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$table'");
            if($query->fetchColumn() != 4){
                self::logMessage('table doesnt exist');
                $query = $con->query(
                    "	CREATE TABLE `board` (
                `ID` int(16) NOT NULL AUTO_INCREMENT,
                `name` varchar(256) NOT NULL,
                `description` text NOT NULL,
                `permLevel` int(16) NOT NULL DEFAULT '0',
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
            self::logMessage("created table $table");
        }
        //table exists
        else{
            self::logMessage("table $table already exists, skipping");
        }
        
        
        $table = 'thread';
        $query = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$table'");
        if($query->fetchColumn() != 4){
            self::logMessage('table doesnt exist');
            $query = $con->query(
                "	CREATE TABLE `thread` (
                `ID` int(16) NOT NULL AUTO_INCREMENT,
                `users_ID` int(16) NOT NULL,
                `board_ID` int(16) NOT NULL,
                `title` varchar(256) NOT NULL,
                `text` text NOT NULL,
                `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
            self::logMessage("created table $table");
            }
            //table exists
            else{
            self::logMessage("table $table already exists, skipping");
        }
        
        $table = 'reply';
        $query = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$table'");
        if($query->fetchColumn() != 4){
            self::logMessage('table doesnt exist');
            $query = $con->query(
                "	CREATE TABLE `reply` (
                `ID` int(16) NOT NULL AUTO_INCREMENT,
                `thread_ID` int(16) NOT NULL,
                `users_ID` int(16) NOT NULL,
                `content` text NOT NULL,
                `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
            self::logMessage("created table $table");
            }
            //table exists
            else{
                self::logMessage("table $table already exists, skipping");
            }
            
            
            
        }
        catch(PDOException $e){
            self::logMessage('PDO ERROR', "FAILURE");
            die("pdo exception, cannot connect to sql:<br> $e");
        }
    }
}

    
    
    
    
    
    
    ?>