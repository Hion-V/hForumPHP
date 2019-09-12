<?php 
require_once("./controller/MVCController.php");
require_once("index.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./view/css/main.css">
	</head>
	<body>
		<header class="row">
<?php 
include_once("./view/webcontent/content_header.php");
?>
		</header>
		<div class="main">
<?php 
$mvcController->loadView();
?>
		</div>
		<footer>
			
		</footer>
	</body>
</html>