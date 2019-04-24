<?php
class Thread{
    static $threadArray = [];
    public $id;
    public $titel;
    public $text;
    public $user;
    public $board;
    public function Thread($id, $titel, $text, $user){
        $this->id = $id;
        $this->titel = $titel;
        $this->text = $text;
        $this->user = $user;
        array_push(Thread::$threadArray, $this);
    }
}

?>