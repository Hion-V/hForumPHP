<?php
require_once(ROOT_DIR.'/controller/db/DBReply.php');
require_once(ROOT_DIR.'/model/forum/Reply.php');
class TA_TestDBReply extends TestAction{
    public function __construct()
    {
        parent::__construct();
    }
    public function execute()
    {
        $replies = DBReply::getAllReplies();
        echo "<div id='response_json'>";
        echo (json_encode($replies));
        echo "</div>";
    }
}
