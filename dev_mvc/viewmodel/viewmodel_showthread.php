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
	$replyOwnerData = DBUser::getUserByUID($reply->getUserID());
	$replyOwner = new User($replyOwnerData['ID'], $replyOwnerData['username'], $replyOwnerData['email'], $replyOwnerData['password'], $replyOwnerData['reg_date'], $replyOwnerData['login_date'], $replyOwnerData['reg_ip'], $replyOwnerData['permissions']);
	$reply->setOwner($replyOwner);
}

// get the person who started the thread
$threadOwnerData = DBUser::getUserByUID($thread->getUserID());
// create user object
$threadOwner = new User($threadOwnerData['ID'], $threadOwnerData['username'], $threadOwnerData['email'], $threadOwnerData['password'], $threadOwnerData['reg_date'], $threadOwnerData['login_date'], $threadOwnerData['reg_ip'], $threadOwnerData['permissions']);
// assign owner and replies
$thread->setReplies($replies);
$thread->setOwner($threadOwner);

// Store data so it can be used in the view
MVCController::$viewData['thread'] = $thread;
?>