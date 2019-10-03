<?php
namespace controller\db;
use model\forum\Board;
use PDO;
class DBBoard extends Database{
	static function getBoards():array
	{
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM board");
		$query->execute();
		$boardArray = [];
		while($result = $query->fetch(PDO::FETCH_BOTH)){
			$board = new Board($result['ID'], $result['name'], $result['description'], $result['permLevel']);
			array_push($boardArray, $board);
		}
		return $boardArray;
	}
	static function registerBoard(Board $board)
	{
		$con = self::connectToDB();
		$query = $con->prepare("INSERT INTO `board` ( `name`, `description`, `permLevel`) VALUES (':name', ':description', :permLevel)");
		$query->bindParam(":name", $board->getName());
		$query->bindParam(":description", $board->description());
		$query->bindParam(":permLevel", $board->permLevel());
		$query->execute();
	}
	
}