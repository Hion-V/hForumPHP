<?php
function populateDB(){
    try{
        if(getenv("SQL_CREDENTIALS") !== false){
            $sql_server = getenv("SQL_SERVER");
            $sql_username = getenv("SQL_USERNAME");
            $sql_password = getenv("SQL_PASSWORD");
            $sql_database = getenv("SQL_DATABASE");
        }
        else{
            $sql_server = "localhost";
            $sql_username = "root";
            $sql_password = "kankerlow";
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
            echol('db doesnt exist');
        }
        //db doesn't exist
        else{
            echol('db already exists, skipping');
        }
        //select db
        $con->exec("USE $db");
        //test if table exists
        
        
        
        echol('table doesnt exist');
        $query = $con->query("INSERT INTO `users` 
                            (`ID`, `username`, `email`, `password`, `reg_ip`, `permissions`, `active`) 
                            VALUES 
                            (NULL, 'Andreas', 'the.hion.v@gmail.com', 'huts', '::1', '-1', '1')");
        $query = $con->query("INSERT INTO `users` 
                            (`ID`, `username`, `email`, `password`, `reg_ip`, `permissions`, `active`) 
                            VALUES 
                            (NULL, 'Bram', 'bram@gmail.com', 'huts', '::1', '-1', '1')");
        echol("created test users");
    }
    catch(PDOException $e){
        die("pdo exception, cannot connect to sql:<br> $e");
    }
}