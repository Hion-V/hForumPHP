<?php
class Board {
	public $id;
	public $name;
	public $permLevel;
	function Board($id, $name, $permLevel){
		$this->id = $id;
		$this->name = $name;
		$this->permLevel = $permLevel;
	}
	
}

