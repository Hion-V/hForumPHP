<?php
namespace model\forum;
class Board {
	public $id;
	public $name;
	public $description;
	public $permLevel;
	function __construct($id, $name, $description, $permLevel){
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->permLevel = $permLevel;
	}
	function setId($id){
		$this->id = $id;
	}
	function setName($name){
		$this->name = $name;
	}
	function setDescription($description){
		$this->description = $description;
	}
	function setPermLevel($permLevel){
		$this->permLevel = $permLevel;
	}
	function getId(){
		return $this->id;
	}
	function getName(){
		return $this->name;
	}
	function getDescription(){
		return $this->description;
	}
	function getPermLevel(){
		return $this->permLevel;
	}
	
}

