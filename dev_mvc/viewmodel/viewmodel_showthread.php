<?php
use controller\MVCController;
use controller\db\DBThread;
use controller\db\DBReply;
use controller\db\DBUser;
use model\forum\User;
use model\forum\Reply;
require_once ROOT_DIR.'/controller/db/DBThread.php';
require_once ROOT_DIR.'/controller/db/DBReply.php';
require_once ROOT_DIR.'/controller/db/DBUser.php';
require_once ROOT_DIR.'/model/forum/User.php';
require_once ROOT_DIR.'/model/forum/Reply.php';
if(isset($_GET['thread'])) {
	$threadid = $_GET['thread'];
} else {
	$threadid = - 1;
}
// Get what we need from the databas 
$thread = DBThread::getThreadByID($threadid);
$replyData = DBReply::getRepliesByThreadID($threadid);
// array to store our reply objects in
$replies = [ ];
// create reply objects from database rows
foreach ($replyData as $row) {
	$reply = new Reply($row['ID'], $row['thread_ID'], $row['users_ID'], $row['content'], $row['date_created']);
	array_push($replies, $reply);
	$replyOwner = DBUser::getUserByUID($reply->getUserID());
	$reply->setOwner($replyOwner);
}

// get the person who started the thread
$threadOwner = DBUser::getUserByUID($thread->getUserID());
// assign owner and replies
$thread->setReplies($replies);
$thread->setOwner($threadOwner);

// Store data so it can be used in the view
MVCController::$viewData['thread'] = $thread;
