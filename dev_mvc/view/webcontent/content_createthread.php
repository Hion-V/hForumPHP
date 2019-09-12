<form action="./" method="post">
	<input type="text" placeholder="Title" name="title"><br>
	<textarea placeholder="post content" name="content"></textarea><br>
	<input type="submit" value="Create Thread">
	<input type="hidden" name="board" value="<?= isset($_GET['board']) ? $_GET['board'] : "-1" ?>">
	<input type="hidden" name="action" value="create_thread">
</form>