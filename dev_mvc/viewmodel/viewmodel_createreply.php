<?php
use controller\MVCController;
if(isset($_GET['thread'])){
	MVCController::$viewData['threadid'] = $_GET['thread'];
}
?>