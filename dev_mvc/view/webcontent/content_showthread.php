<?php 
use controller\MVCController;
use model\forum\Thread;
use model\forum\Reply;
use model\forum\User;
//$thread = new Thread();
$thread = MVCController::$viewData['thread'];
$replies = $thread->getReplies();
?>
<table>
	<h1>
		<?=$thread->getTitle()?>
	</h1>
	<tr>
		<th width="10%">user</th>
		<th width="80%">content</th>
		<th width="10%">date</th>
	</tr>
	<tr>
		<td>
			<?=$thread->getOwner()->getUsername();?>
		</td>
		<td>
			<?=$thread->getContent()?>
		</td>
		<td>
			<?=$thread->getDate_created()->format("Y M d H:i:s")?>
		</td>
	</tr>
<?php 
foreach($replies as $reply){
	$owner = $reply->getOwner()->getUsername();
	$content = $reply->getContent();
	$date_created = $reply->getDate()->format("Y M d H:i:s");
	echo("<tr>");
	echo("<td>$owner</td>");
	echo("<td>$content</td>");
	echo("<td>$date_created</td>");
	echo("</tr>");
}
?>
</table>
<?php
$threadID = $thread->getId();
echo "<a href=\"?p=createreply&thread=$threadID\">Create Reply</a>"
?>