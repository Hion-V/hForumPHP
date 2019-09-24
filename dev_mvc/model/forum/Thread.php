<?php
class Thread {
	public $id;
	public $title;
	public $boardID;
	public $userID;
	public $content;
	public $date_created;
	public $replies = [];
	public $lastReplyDate;
	public $owner;
	

	function __construct($id, $userID, $boardID, $title, $content, $date_created = null) {
		$this->id = $id;
		$this->title = $title;
		$this->boardID = $boardID;
		$this->userID = $userID;
		$this->content = $content;
		
		$dateTime = new DateTime($date_created);
		$this->date_created = $dateTime;
		
		/*
		if(isset($threadData)){
			$this->id = $threadData['id'];
			$this->title = $threadData['title'];
			$this->boardID = $threadData['boardID'];
			$this->userID = $threadData['userID'];
			$this->content = $threadData['content'];
		}
		*/
	}
	/**
	 * @return multitype:
	 */
	public function getReplies() {
		return $this->replies;
	}
	
	/**
	 * @return mixed
	 */
	public function getOwner():User {
		return $this->owner;
	}
	
	/**
	 * @param multitype: $replies
	 */
	public function setReplies($replies) {
		$this->replies = $replies;
	}
	
	/**
	 * @param mixed $owner
	 */
	public function setOwner($owner) {
		$this->owner = $owner;
	}
	
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @return string $title
	 */
	public function getTitle():string {
		return $this->title;
	}
	
	/**
	 * @return int $boardID
	 */
	public function getBoardID() {
		return $this->boardID;
	}
	
	/**
	 * @return int $userID
	 */
	public function getUserID() {
		return $this->userID;
	}
	
	/**
	 * @return string $content
	 */
	public function getContent():string {
		return $this->content;
	}
	
	/**
	 * @param string $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	/**
	 * @param string $boardID
	 */
	public function setBoardID($boardID) {
		$this->boardID = $boardID;
	}
	
	/**
	 * @param string $userID
	 */
	public function setUserID($userID) {
		$this->userID = $userID;
	}
	
	/**
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}
	/**
	 * @return DateTime
	 */
	public function getDate_created() {
		return $this->date_created;
	}
	
	/**
	 * @param DateTime $date_created
	 */
	public function setDate_created($date_created) {
		$this->date_created = $date_created;
	}
	
}

