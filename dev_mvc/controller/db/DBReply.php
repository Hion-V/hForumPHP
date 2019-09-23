<?php
require_once ROOT_DIR.'/controller/db/Database.php';

class DBReply extends Database{
	static function createReply($uid, $threadID, $content){
		$con = self::connectToDB();
		$query = $con->prepare("INSERT INTO reply (thread_ID, users_ID, content) VALUES (:tid, :uid, :content);");
		$query->bindParam(":uid", $uid);
		$query->bindParam(":tid", $threadID);
		$query->bindParam(":content", $content);
		echo "$uid, $threadID, $content";
		$query->execute();
	}
	static function getReplyByID($id):array
	{
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM reply WHERE id = :id");
		$query->bindParam(":id", $id);
		$query->execute();
		return $query->fetch(PDO::FETCH_BOTH);
		
	}
	static function getRepliesByThreadID($tid):array
	{
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM reply WHERE thread_ID = :tid");
		$query->bindParam(":tid", $tid);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_BOTH);
	}
	static function getLastReplyByThreadID():array
	{
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM reply WHERE thread_ID = :tid ORDER BY date_created DESC LIMIT 1");
		$query->bindParam(":tid", $tid);
		$query->execute();
		return $query->fetch(PDO::FETCH_BOTH);
	}
}