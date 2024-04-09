<?php
use controller\MVCController;
use controller\db\DBBoard;
use controller\db\DBThread;
use controller\db\DBUser;
use model\forum\Board;
use model\forum\Thread;
use model\forum\User;
use model\forum\Reply;


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