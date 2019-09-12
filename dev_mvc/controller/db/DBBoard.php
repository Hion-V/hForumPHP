<?php
require_once './controller/db/Database.php';
class DBBoard extends Database{
	static function getBoards():array
	{
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM board");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_BOTH);
	}
	
}