<?php
require_once './controller/db/DBThread.php';
require_once './controller/db/DBReply.php';
require_once './controller/db/DBUser.php';
require_once './model/forum/User.php';
require_once './model/forum/Reply.php';
if(isset($_GET['thread'])) {
	$threadid = $_GET['thread'];
} else {
	$threadid = - 1;
}
// Get what we need from the database
$threadData = DBThread::getThreadByID($threadid);
$thread = new Thread($threadData['ID'], $threadData['users_ID'], $threadData['board_ID'], $threadData['title'], $threadData['text'], $threadData['date_created']);
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
?>