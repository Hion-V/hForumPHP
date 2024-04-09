<?php
namespace controller\db;
use PDO;
Class DBTables extends Database{
    static function createAllTables(){
        $con = self::connectToDB();
        self::createUserTable($con);
        self::createEmailActivationKeyTable($con);
        self::createBoardTable($con);
        self::createThreadTable($con);
        self::createReplyTable($con);
    }
    static function createUserTable($con){
        $table = 'users';
        if(!self::checkTableExists($table, $con)){
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
        }
    }
    static function createEmailActivationKeyTable($con){
        $table = 'email_activation_keys';
        if(!self::checkTableExists($table, $con)){
            $query = $con->query(
                "	CREATE TABLE `email_activation_keys` (
                `id` int(16) NOT NULL AUTO_INCREMENT,
                `users_id` int(16) NOT NULL,
                `activationkey` varchar(256) NOT NULL,
                PRIMARY KEY (`id`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
        }
    }
    static function createBoardTable($con){
        $table = 'board';
        if(!self::checkTableExists($table, $con)){
                $query = $con->query(
                    "	CREATE TABLE `board` (
                `ID` int(16) NOT NULL AUTO_INCREMENT,
                `name` varchar(256) NOT NULL,
                `description` text NOT NULL,
                `permLevel` int(16) NOT NULL DEFAULT '0',
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
        }
    }
    static function createThreadTable($con){
        $table = 'thread';
        if(!self::checkTableExists($table, $con)){
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
        }
    }
    static function createReplyTable($con){
        $table = 'reply';
        if(!self::checkTableExists($table, $con)){
            $query = $con->query(
                "	CREATE TABLE `reply` (
                `ID` int(16) NOT NULL AUTO_INCREMENT,
                `thread_ID` int(16) NOT NULL,
                `users_ID` int(16) NOT NULL,
                `content` text NOT NULL,
                `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
        }
    }
    static function checkTableExists($table, $con){
        $query = $con->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$table'");
        //table doesn't exist
        if($query->fetchColumn() != 1){
            return false;
        }else{
            return true;
        }
    }
}