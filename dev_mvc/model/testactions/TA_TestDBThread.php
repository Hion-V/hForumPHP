<?php
require_once(ROOT_DIR.'/controller/db/DBThread.php');
require_once(ROOT_DIR.'/model/forum/Thread.php');
class TA_TestDBThread extends TestAction{
    function __construct(){
        parent::__construct();
    }
    function execute(){
        $replies = DBReply::getAllReplies();
        echo "<div id='response_json'>";
        echo (json_encode($replies));
        echo "</div>";
    }
}