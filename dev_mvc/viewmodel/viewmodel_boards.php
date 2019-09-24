<?php
require_once ROOT_DIR.'/controller/db/DBBoard.php';
require_once ROOT_DIR.'/controller/db/DBThread.php';
require_once ROOT_DIR.'/controller/db/DBUser.php';
require_once ROOT_DIR.'/model/forum/Board.php';
require_once ROOT_DIR.'/model/forum/Thread.php';
require_once ROOT_DIR.'/model/forum/User.php';
require_once ROOT_DIR.'/model/forum/Reply.php';

$boards = DBBoard::getBoards();
$users = [];
$threads = [];
$threadUsers = [];
foreach ($boards as $board)
{	
	$threads = array_merge($threads, DBThread::getThreadsByBoard($board->getId())); 
}
foreach($threads as $thread)
{	
	array_push($users, DBUser::getUserByUID($thread->getUserID()));
}




//MVCController::$viewData['boards'] = [new Board(0, "General", 0),new Board(1, "Admin board", 10)];
MVCController::$viewData['boards'] = $boards;
MVCController::$viewData['threads'] = $threads;
MVCController::$viewData['users'] = $users;
MVCController::$viewData['replies'] = [new Reply(0, 0, 0, "op is gay","01-01-1990")];
?>