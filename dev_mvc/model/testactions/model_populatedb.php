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
        $query = $con->query("INSERT INTO users (username, email, password, login_date, reg_ip, active) VALUES ( 'andreas', 'andreas@andreas.nl', 'jenk', '2019-01-01 14:35:33', '192.168.0.2', 1),
                                                                                                               ( 'bram', 'bram@bram.nl', 'jenk', '2019-01-01 14:35:33', '192.168.0.1', 1)");
        echol("created test users");
        $query = $con->query("INSERT INTO `board` (`name`, `description`, `permLevel`) VALUES ('General Discussion', 'Plek om algemene discussie te voeren.', '0'), 
                                                                                              ('Off Topic', 'Voor alle irrelevante zooi.', '0')");
        echol("created test boards");
        $query = $con->query("INSERT INTO `thread` (`users_ID`, `board_ID`, `title`, `text`, `date_created`) VALUES ('1', '1', 'Test thread', 'Deze thread is een test.', '2019-06-20 13:55:37'), 
                                                                                                                    ('1', '2', 'Waa', 'Frist niffo', '2019-06-20 13:56:42')");
        echol("created test threads");
        $query = $con->query("INSERT INTO `reply` (`thread_ID`, `users_ID`, `content`, `date_created`) VALUES ('1', '1', 'heehee eks dee', '2019-06-21 11:01:57'), 
                                                                                                              ('1', '1', 'hoi\r\n', '2019-06-21 11:07:25'), 
                                                                                                              ('2', '2', 'fristi niBBa', '2019-06-21 11:08:08'), 
                                                                                                              ('1', '1', 'was jouw prebleem', '2019-06-21 14:41:00'), 
                                                                                                              ('1', '2', 'Mijn naam is bram', '2019-06-21 17:58:12'), 
                                                                                                              ('1', '2', 'huh wuddufuq', '2019-06-21 17:58:29'), 
                                                                                                              ('1', '1', 'huts a neef', '2019-06-21 17:59:27')");
        echol("created test replies");
    }
    catch(PDOException $e){
        die("pdo exception, cannot connect to sql:<br> $e");
    }
}