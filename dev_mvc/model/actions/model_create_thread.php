<?php
require_once './controller/UserSession.php';
require_once('./controller/HUtils.php');
require_once './controller/db/DBThread.php';
require_once './model/forum/Thread.php';
//dit bestand bestaat grotendeels uit dummy code.
//Ik heb onvoldoende tijd gehad tijdens de afgelopen paar weken en het was extreem druk in de klas tijdens de les.
$uid = $_SESSION['usersession']->uid;
if(HUtils::issetPost(['title', 'content', 'board']));
{
	$thread = new Thread(-1, $uid, $_POST['board'], $_POST['title'], $_POST['content']);
	DBThread::createThread($thread);
}
?>
