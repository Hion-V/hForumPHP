<?php
require_once ROOT_DIR.'./controller/db/DBBoard.php';
require_once ROOT_DIR.'./controller/db/DBThread.php';
require_once ROOT_DIR.'./controller/db/DBUser.php';
require_once ROOT_DIR.'./model/forum/Board.php';
require_once ROOT_DIR.'./model/forum/Thread.php';
require_once ROOT_DIR.'./model/forum/User.php';
require_once ROOT_DIR.'./model/forum/Reply.php';

$boardTable = DBBoard::getBoards();
$threadsTable = [];
$usersTable = [];
$boards = [];
$threads = [];
$users = [];
foreach ($boardTable as $row)
{	
	$threadsTable = array_merge($threadsTable, DBThread::getThreadsByBoard($row['ID'])); 
	array_push($boards, new Board($row['ID'], $row['name'], $row['permLevel']));
}
foreach($threadsTable as $row)
{
	
	array_push($threads, new Thread($row['ID'],$row['users_ID'],$row['board_ID'],$row['title'],$row['text'],$row['date_created']));
	array_push($usersTable, DBUser::getUserByUID($row['users_ID']));

}
foreach($usersTable as $row){
	$skipUser = false;
	foreach($users as $user){
		if($row->getId() == $user->getId()){
			$skipUser = true;
		}
	}
	if(!$skipUser){
		array_push($users, $row);
	}
}



//MVCController::$viewData['boards'] = [new Board(0, "General", 0),new Board(1, "Admin board", 10)];
MVCController::$viewData['boards'] = $boards;
MVCController::$viewData['threads'] = $threads;
MVCController::$viewData['users'] = $users;
MVCController::$viewData['replies'] = [new Reply(0, 0, 0, "op is gay","01-01-1990")];
?>