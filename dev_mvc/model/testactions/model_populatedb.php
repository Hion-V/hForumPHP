<?php
if(isset($_POST['auth'])){
    if($_POST['auth'] == getenv('ADMIN_ACTION_KEY')){
        populateDB();
    }
}else{
    echol('you have no authorization to do that');
}

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
        $con->exec("USE $db");
        
        
        
        echol('table doesnt exist');
        $query = $con->query("INSERT INTO users (username, email, password, login_date, reg_ip, active) VALUES ( 'andreas' , 'andreas@andreas.nl', 'jenk', '0000-00-00 00:00:00', '192.168.0.2', 1)");
        $query = $con->query("INSERT INTO users (username, email, password, login_date, reg_ip, active) VALUES ( 'bram' , 'bram@bram.nl', 'jenk', '0000-00-00 00:00:00', '192.168.0.1', 1)");
        echol("created test users");
    }
    catch(PDOException $e){
        die("pdo exception, cannot connect to sql:<br> $e");
    }
}