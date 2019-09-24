<?php
require_once ROOT_DIR.'/controller/db/Database.php';
class DBBoard extends Database{
	static function getBoards():array
	{
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM board");
		$query->execute();
		$boardArray = [];
		while($result = $query->fetch(PDO::FETCH_BOTH)){
			$board = new Board($result['ID'],$result['name'],$result['permLevel']);
			array_push($boardArray, $board);
		}
		return $boardArray;
	}
	
}