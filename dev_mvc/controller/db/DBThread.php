<?php
require_once ROOT_DIR.'./model/forum/Thread.php';
class DBThread extends Database {
	static function getThreadByID($id){
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM thread WHERE ID = :id");
		$query->bindParam(":id", $id);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_BOTH); 
		return new Thread($result['ID'], $result['users_ID'], $result['board_ID'], $result['title'], $result['text'], $result['date_created']);
	}
	static function getThreadsByBoard($boardID){
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM thread WHERE board_ID = :boardID");
		$query->bindParam(":boardID", $boardID);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_BOTH);
	}
	static function createThread($threadObject){
		$con = self::connectToDB();
		$query = $con->prepare(	"INSERT INTO thread" . 
								"(users_ID, board_ID, title, text)" . 
								"VALUES (:uid, :bid, :title, :content);");
		
		$uid = $threadObject->getUserID();
		$bid = $threadObject->getBoardID();
		$title = $threadObject->getTitle();
		$content = $threadObject->getContent();
		
		$query->bindParam(":uid", $uid);
		$query->bindParam(":bid", $bid);
		$query->bindParam(":title", $title);
		$query->bindParam(":content", $content);
		$query->execute();
	}
	
}

