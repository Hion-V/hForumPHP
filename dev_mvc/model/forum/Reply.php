<?php
namespace model\forum;
use DateTime;
class Reply {
	public $id;
	public $threadID;
	public $userID;
	public $content;
	public $date;
	public $owner;
	
	function __construct($id, $threadID, $userID, $content, $date = null){
		$this->id = $id;
		$this->threadID = $threadID;
		$this->userID = $userID;
		$this->content = $content;
		$dateTime = new DateTime($date);
		$this->date = $dateTime;
	}
	/**
	 * @return mixed
	 */
	public function getOwner():User {
		return $this->owner;
	}
	
	/**
	 * @param mixed $owner
	 */
	public function setOwner($owner) {
		$this->owner = $owner;
	}
	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getThreadID() {
		return $this->threadID;
	}

	/**
	 * @return mixed
	 */
	public function getUserID() {
		return $this->userID;
	}

	/**
	 * @return mixed
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @return mixed
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param mixed $threadID
	 */
	public function setThreadID($threadID) {
		$this->threadID = $threadID;
	}

	/**
	 * @param mixed $userID
	 */
	public function setUserID($userID) {
		$this->userID = $userID;
	}

	/**
	 * @param mixed $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @param mixed $date
	 */
	public function setDate($date) {
		$this->date = $date;
	}

}

