<?php
namespace model\forum;
class Board {
	public $id;
	public $name;
	public $permLevel;
	function __construct($id, $name, $permLevel){
		$this->id = $id;
		$this->name = $name;
		$this->permLevel = $permLevel;
	}
	function getId(){
		return $this->id;
	}
	function getName(){
		return $this->name;
	}
	function getPermLevel(){
		return $this->permLevel;
	}
	
}

