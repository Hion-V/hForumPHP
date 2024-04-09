<?php
namespace model\testactions;
use controller\db\DBThread;
use model\forum\Thread;
class TA_TestDBThread extends TestAction{
    function __construct(){
        parent::__construct();
    }
    function execute(){
        $threads = DBThread::getAllThreads();
        echo "<div id='response_json'>";
        echo (json_encode($threads));
        echo "</div>";
    }
}