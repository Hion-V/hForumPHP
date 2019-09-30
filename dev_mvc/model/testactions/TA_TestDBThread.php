<?php
namespace model\testactions;
require_once(ROOT_DIR.'/controller/db/DBThread.php');
require_once(ROOT_DIR.'/model/forum/Thread.php');
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