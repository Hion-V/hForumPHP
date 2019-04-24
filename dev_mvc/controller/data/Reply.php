<?php
class Reply{
    public $id;
    public $user;
    public $thread;
    public $text;
    function Reply($id, $user, $thread, $text){
        $this->id = $id;
        $this->user = $user;
        $this->thread = $thread;
        $this->text = $text;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getUser(){
        return $this->user;
    }
    public function setUser($user){
        $this->user = $user;
    }
    public function getThread(){
        return $this->thread;
    }
    public function setThread($thread){
        $this->thread = $thread;
    }
    public function getText(){
        return $this->text;
    }
    public function setText($text){
        $this->text = $text;
    }
}
?>