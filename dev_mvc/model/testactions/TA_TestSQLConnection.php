<?php
class TA_TestSQLConnection{
    function __construct(){
        parent::_construct();
    }
    function execute(){
        echo $this->testSQLConnection();
    }
    function testSQLConnection(){
        $connectionStatus = false;
        try{
			//Defineer vars
			if(getenv("SQL_CREDENTIALS") !== false){
				$sql_server = getenv("SQL_SERVER");
				$sql_username = getenv("SQL_USERNAME");
				$sql_password = getenv("SQL_PASSWORD");
			}
			else{
				$sql_server = "localhost";
				$sql_username = "root";
				$sql_password = "kankerlow";
			}
			$dsn = "mysql:host=$sql_server";
			//Maak verbinding
			$con = new PDO($dsn, $sql_username, $sql_password);
			$connectionStatus = true;
		}
		catch(PDOException $e){
			echo("PDO Exception, can't connect to database.");
            die($e);
            $connectionStatus = false;
        }
        return $connectionStatus;
	}
}