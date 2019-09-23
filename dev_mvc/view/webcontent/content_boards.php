<?php
require_once ROOT_DIR.'./model/forum/Thread.php';
require_once ROOT_DIR.'./model/forum/User.php';
foreach (MVCController::$viewData['boards'] as $board){ 
	include './view/webcontent/modules/modules_boards/module_boardtable.php';
}
?>