<form action="./?p=showthread&thread=<?=MVCController::$viewData['threadid'];?>" method="post">
<textarea placeholder="post content" name="content"></textarea><br>
<input type="submit" value="Create Reply">
<input type="hidden" name="thread" value="<?=MVCController::$viewData['threadid'];?>">
<input type="hidden" name="action" value="create_reply">
</form>