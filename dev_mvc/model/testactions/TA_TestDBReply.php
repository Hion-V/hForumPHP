<?php
namespace model\testactions;
use controller\db\DBReply;
use model\forum\Reply;
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
