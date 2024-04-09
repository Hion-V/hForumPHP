<?php
use controller\MVCController;
foreach (MVCController::$viewData['boards'] as $board){ 
	include ROOT_DIR.'/view/webcontent/modules/modules_boards/module_boardtable.php';
}
?>