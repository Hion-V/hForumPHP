<?php
Class Database{
	static function connectToDB(){
		//Defineer vars
		$sql_server = "localhost";
		$sql_username = "root";
		$sql_password = "kankerlow";
		$sql_database = "webforum";
		$dsn = "mysql:host=$sql_server;dbname=$sql_database";
		//Maak verbinding
		$con = new PDO($dsn, $sql_username, $sql_password);
		return $con;
	}
	
	/***
	 *      ______ __  __          _____ _                 _____ _______ _______      __  _______ _____ ____  _   _
	 *     |  ____|  \/  |   /\   |_   _| |          /\   / ____|__   __|_   _\ \    / /\|__   __|_   _/ __ \| \ | |
	 *     | |__  | \  / |  /  \    | | | |         /  \ | |       | |    | |  \ \  / /  \  | |    | || |  | |  \| |
	 *     |  __| | |\/| | / /\ \   | | | |        / /\ \| |       | |    | |   \ \/ / /\ \ | |    | || |  | | . ` |
	 *     | |____| |  | |/ ____ \ _| |_| |____   / ____ \ |____   | |   _| |_   \  / ____ \| |   _| || |__| | |\  |
	 *     |______|_|  |_/_/    \_\_____|______| /_/    \_\_____|  |_|  |_____|   \/_/    \_\_|  |_____\____/|_| \_|
	 *
	 *
	 ***/
	
	//Kijk of de user activation key al bestaat in de databse.
	static function doesUserActivationKeyExist($activationKey){
		$con = Database::connectToDB();
		$query = $con->prepare("SELECT * FROM email_activation_keys WHERE activationkey = :activationKey");
		$query->bindParam(':activationKey', $activationKey, PDO::PARAM_STR, 256);
		$query->execute();
		if($query->rowCount() == 0){
			//bestaat nog niet
			return false;
		}
		else{
			//bestaat al
			return true;
		}
	}
	static function registerActivationKey($users_id, $activationKey){
		$con = Database::connectToDB();
		$query = $con->prepare("INSERT INTO email_activation_keys (users_id, activationkey) VALUES (:users_id, :activationkey)");
		$query->bindParam(':users_id', $users_id);
		$query->bindParam(':activationkey', $activationKey);
		$query->execute();
	}
	
	
	
	//Activeer gebruiker en verwijder activation key uit de activation key tabel
	static function activateUser($activationKey){
		$con = Database::connectToDb();
		$query = $con->prepare("SELECT users_id FROM email_activation_keys WHERE activationKey = :activationKey");
		$query->bindParam('activationKey', $activationKey);
		$query->execute();
		$result = -1;
		if($query->rowCount() == 1){
			//login correct, return uid
			$result = $query->fetch(PDO::FETCH_COLUMN);
		}
		else{
			//activation key komt niet voor in de db, return -1
			return -1;
		}
		$id = $result;
		$query = null;
		$query = $con->prepare("UPDATE users SET active = 1 WHERE id = :id and active = 0");
		$query->bindParam(':id',$id,PDO::PARAM_INT);
		$query->execute();
	}
	
	/***
	 *       _____ ______  _____ _____ _____ ____  _   _   _______ ____  _  ________ _   _  _____
	 *      / ____|  ____|/ ____/ ____|_   _/ __ \| \ | | |__   __/ __ \| |/ /  ____| \ | |/ ____|
	 *     | (___ | |__  | (___| (___   | || |  | |  \| |    | | | |  | | ' /| |__  |  \| | (___
	 *      \___ \|  __|  \___ \\___ \  | || |  | | . ` |    | | | |  | |  < |  __| | . ` |\___ \
	 *      ____) | |____ ____) |___) |_| || |__| | |\  |    | | | |__| | . \| |____| |\  |____) |
	 *     |_____/|______|_____/_____/|_____\____/|_| \_|    |_|  \____/|_|\_\______|_| \_|_____/
	 *
	 ***/
	
	
	static function isSessionTokenInUse($token){
		//Init db connection
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("SELECT * FROM usersessions where token = :token");
		//Bind params
		$query->bindParam(':token', $token, PDO::PARAM_STR, 256);
		//Voer query it
		$query->execute();
		//Check hoeveelheid teruggestuurde rijen
		if($query->rowCount() == 0){
			return false;
		}
		else{
			return true;
		}
	}
	static function registerNewSession($uid, $token, $expires){
		//Init db connection
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("INSERT INTO usersessions (uid, token, expires) VALUES (:uid, :token, :expires)");
		//Bind params
		$query->bindParam(':uid', $uid, PDO::PARAM_INT);
		$query->bindParam(':token', $token, PDO::PARAM_STR, 256);
		$query->bindParam(':expires', $expires, PDO::PARAM_STR);
		//Voer query it
		$query->execute();
	}
	static function isSessionValid($token, $uid){
		//Init db connection
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("SELECT * FROM usersessions where token = :token AND uid = :uid AND expires > NOW()");
		//Bind params
		$query->bindParam(':token', $token, PDO::PARAM_STR, 256);
		$query->bindParam(':uid', $uid, PDO::PARAM_STR, 256);
		//Voer query it
		$query->execute();
		//Check hoeveelheid teruggestuurde rijen
		if($query->rowCount() == 1){
			return true;
		}
		else{
			return false;
		}
	}
	static function invalidateSession($token){
		//Init db connection
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("DELETE FROM usersessions WHERE token = :token");
		//Bind params
		$query->bindParam(':token', $token, PDO::PARAM_STR, 256);
		//Voer query it
		$query->execute();
	}
	static function invalidateSessionByUID($uid){
		//Init db connection
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("DELETE FROM usersessions WHERE uid = :uid");
		//Bind params
		$query->bindParam(':token', $uid, PDO::PARAM_INT);
		//Voer query it
		$query->execute();
	}
	static function deleteExpiredSessions(){
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("DELETE FROM usersessions WHERE expires < NOW()");
		$query->execute();
	}
	static function getSessionExpiryDate($token){
		$con = Database::connectToDB();
		$query = $con->prepare("SELECT expires FROM usersessions where token = :token");
		$query->bindParam(':token', $token, PDO::PARAM_STR, 256);
		$query->execute();
		if($query->rowCount() == 1){
			//login correct, return uid
			$result = $query->fetch(PDO::FETCH_COLUMN);
			return $result;
		}
		else{
			//something went wrong, return an invalid date.
			return "2000-01-01 00:00:00";
		}
	}
}