<?php
use controller\UserSession;
use controller\HUtils;
use controller\db\DBReply;
Use model\forum\Reply;
//dit bestand bestaat grotendeels uit dummy code.
//Ik heb onvoldoende tijd gehad tijdens de afgelopen paar weken en het was extreem druk in de klas tijdens de les.
$uid = $_SESSION['usersession']->uid;
if(HUtils::issetPost(['thread', 'content']));
{
	$reply = new Reply(-1, $_POST['thread'], $uid, $_POST['content']);
	print_r($reply);
	DBReply::createReply($reply->getUserid(), $reply->getThreadID(), $reply->getContent());
}
?>
