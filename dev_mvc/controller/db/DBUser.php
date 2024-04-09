<?php
namespace controller\db;
use model\forum\User;
use PDO;
class DBUser extends Database
{
	static function getUserByUID($uid){
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM users WHERE ID = :uid");
		$query->bindParam(":uid", $uid);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_BOTH);
		$user = new User($result['ID'], $result['username'], $result['email'], $result['password'], $result['reg_date'], $result['login_date'], $result['reg_ip'], $result['permissions'], $result['active']);
		return $user;
	}

    /**
     * @return array
     */
    static function getAllUsers():array
    {
        $con = self::connectToDB();
        $query = $con->prepare("SELECT * FROM users");
        $query->bindParam(":uid", $uid);
        $query->execute();
        $query->rowCount();
        $userArray = [];
        while ($result = $query->fetch(PDO::FETCH_BOTH)) {
            $user = new User($result['ID'], $result['username'], $result['email'], $result['password'], $result['reg_date'], $result['login_date'], $result['reg_ip'], $result['permissions'], $result['active']);
            array_push($userArray, $user);
        }
        return $userArray;
    }
	static function getUserByEmail($email){
		$con = self::connectToDB();
		$query = $con->prepare("SELECT * FROM users WHERE email = :email");
		$query->bindParam(":email", $email);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_BOTH);
		$user = new User($result['ID'], $result['username'], $result['email'], $result['password'], $result['reg_date'], $result['login_date'], $result['reg_ip'], $result['permissions'], $result['active']);
		if($query->rowCount() == 1){
			//Email adres is niet in gebruik, return false
			return $user;
		}
		else if($query->rowCount() == 0){
			trigger_error("Email $email not found in DB", E_USER_ERROR);
		}
		else{
			//Email is al in gebruik of komt meer dan een keer voor. Beide gevallen zijn een probleem dus return true.
			trigger_error("Multiple users for email $email returned by DB, value should be unique", E_USER_ERROR);
		}
		
	}
	
	
	//Controleert of het email adres al in de database voorkomt. Returnt true indien wel.
	static function checkUsedEmail($email){
		//Verbind met de database
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("SELECT * FROM users where email = :email");
		//Bind parameters
		$query->bindParam(':email', $email, PDO::PARAM_STR, 256);
		//Voer de query uit
		$query->execute();
		//Check de hoeveelheid rijen die de database returnt.
		if($query->rowCount() == 0){
			//Email adres is niet in gebruik, return false
			return false;
		}
		else{
			//Email is al in gebruik of komt meer dan een keer voor. Beide gevallen zijn een probleem dus return true.
			return true;
		}
	}
	//Controleert of de gebruikersnaam al in de database voorkomt. Returnt true indien wel.
	static function checkUsedUsername($username){
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("SELECT * FROM users where username = :username");
		//Bind parameters
		$query->bindParam(':username', $username, PDO::PARAM_STR, 256);
		//Voer de query uit
		$query->execute();
		//Check de hoeveelheid rijen die de database returnt.
		if($query->rowCount() == 0){
			//Username adres is niet in gebruik, return false
			return false;
		}
		else{
			//Username is al in gebruik of komt meer dan een keer voor. Beide gevallen zijn een probleem dus return true.
			return true;
		}
	}
	//Registreert een gebruiker. Neemt als invoer email, wachtwoord, gebruikersnaam. en email activation key. Nog niet volledig geimplementeerd
	static function registerUser($email, $password, $username){
		$ip = $_SERVER['REMOTE_ADDR'];
		//Initit db connection
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("INSERT INTO users (username, email, password, reg_ip) VALUES (:username, :email, :password, :ip)");
		//Bind parameters
		$query->bindParam(':username', $username, PDO::PARAM_STR, 256);
		$query->bindParam(':email', $email, PDO::PARAM_STR, 256);
		$query->bindParam(':password', $password, PDO::PARAM_STR, 256);
		$query->bindParam(':ip', $ip, PDO::PARAM_STR, 256);
		//Voer query uit
		$query->execute();
	}
	//Check of gegeven login info in de database voorkomt
	static function isLoginValid($email, $password){
		//Init db connection
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("SELECT * FROM users where email = :email AND password = :password");
		//Bind params
		$query->bindParam(':email', $email, PDO::PARAM_STR, 256);
		$query->bindParam(':password', $password, PDO::PARAM_STR, 256);
		//Voer query it
		$query->execute();
		//Check hoeveelheid teruggestuurde rijen
		if($query->rowCount() == 1){
			//login correct (komt voor in de db)
			return true;
		}
		else{
			//Incorrect
			return false;
		}
	}
	//Vraag gebruikers ID op doormiddel van email en pass
	static function getUID($email, $password){
		//Init db connection
		$con = Database::connectToDB();
		//Bereid query voor
		$query = $con->prepare("SELECT id FROM users where email = :email AND password = :password");
		//Bind params
		$query->bindParam(':email', $email, PDO::PARAM_STR, 256);
		$query->bindParam(':password', $password, PDO::PARAM_STR, 256);
		//Voer query it
		$query->execute();
		//Check hoeveelheid teruggestuurde rijen
		if($query->rowCount() == 1){
			//login correct, return uid
			$result = $query->fetch(PDO::FETCH_COLUMN);
			return $result;
		}
		else{
			//something went wrong, return -1
			return -1;
		}
	}
	static function getUsername($uid){
		$con = Database::connectToDB();
		$query = $con->prepare("SELECT username FROM users where id = :uid");
		$query->bindParam(':uid', $uid, PDO::PARAM_STR, 256);
		$query->execute();
		if($query->rowCount() == 1){
			//login correct, return uid
			$result = $query->fetch(PDO::FETCH_COLUMN);
			return $result;
		}
		else{
			//something went wrong, return -1
			return "db_user_invalid";
		}
	}
}