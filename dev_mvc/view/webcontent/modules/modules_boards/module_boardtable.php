<?php
use controller\MVCController;
?>
			<h2><?=$board->name?></h2>
			<a href="?p=createthread&board=<?=$board->id?>">Create Thread</a>
			<table>
				<tr>
					<th>Thread</th>
					<th width=10%>Started by</th>
					<th width=15%>Last reply</th>
				</tr>
<?php
foreach (MVCController::$viewData['threads'] as $thread){
	if($thread->getBoardID() == $board->id){
		$currentRow = [];
		$currentRow['threadID'] = $thread->getID();
		$currentRow['threadTitle'] = $thread->getTitle();
		foreach(MVCController::$viewData['users'] as $user){
			if($user->getID() == $thread->getUserID()){
				$currentRow['username'] = $user->getUsername();
				break;
			}
		}
		foreach(MVCController::$viewData['replies'] as $reply){
			if(isset($reply)){
				if($reply->getThreadID() == $thread->getId())
				{
					break;
				}else{
					$currentRow['lastUpdated'] = $thread->getDate_created()->format("Y M d H:i:s");
				}
			}
		}
?>
				<tr>
					<td>
						<a href="?p=showthread&thread=<?=$currentRow['threadID']?>"><?=$currentRow['threadTitle']?></a>
					</td>
					<td>
						<?=$currentRow['username'] ?>
						
					</td>
					<td>
						<?=$currentRow['lastUpdated']?>
						
					</td>
				</tr>
<?php
	}
}
?>
			</table>
